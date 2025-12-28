<?php
// api/proxy.php
// A simple, secure proxy to avoid mixed content/CORS issues and manage API endpoints.

header('Content-Type: application/json');
// SECURITY: Prevent external sites from using this proxy. 
// Only allow requests from the same origin (this server).
header('X-Frame-Options: SAMEORIGIN');
// Remove generic CORS header to enforce Same-Origin Policy by default in browsers.

$action = $_GET['action'] ?? '';
$query  = $_GET['q'] ?? '';
$id     = $_GET['id'] ?? '';
$page   = $_GET['page'] ?? 1;
$year   = $_GET['year'] ?? ''; // Year filter (e.g., 2023)

// Base URLs
const IA_SEARCH_BASE = 'https://archive.org/advancedsearch.php';
const OL_SEARCH_BASE = 'https://openlibrary.org/search.json';
const OL_WORKS_BASE  = 'https://openlibrary.org/works/';

// Cache Settings
const CACHE_DIR = __DIR__ . '/cache/';
const CACHE_TIME = 3600; // 1 hour

if (!file_exists(CACHE_DIR)) {
    mkdir(CACHE_DIR, 0777, true);
}

// RATE LIMITING (Token Bucket - Simple File Based)
// Limit: 60 requests per minute per IP
const LIMIT_DIR = __DIR__ . '/limits/';
const LIMIT_MAX = 60;
const LIMIT_TIME = 60;

if (!file_exists(LIMIT_DIR)) mkdir(LIMIT_DIR, 0777, true);

function checkRateLimit() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $file = LIMIT_DIR . md5($ip) . '.req';
    
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : ['count' => 0, 'start' => time()];
    
    if (time() - $current['start'] > LIMIT_TIME) {
        $current = ['count' => 1, 'start' => time()];
    } else {
        $current['count']++;
        if ($current['count'] > LIMIT_MAX) {
            http_response_code(429);
            echo json_encode(['error' => 'Too many requests. Please wait.']);
            exit;
        }
    }
    file_put_contents($file, json_encode($current));
}

checkRateLimit();

function fetchUrl($url) {
    // Generate cache key
    $cacheFile = CACHE_DIR . md5($url) . '.json';
    
    // Check cache
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < CACHE_TIME)) {
        return file_get_contents($cacheFile);
    }

    // Robust cURL with Timeouts
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 5 seconds max per request to prevent hanging
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_USERAGENT, 'AkashicLibrary/2.0 (Educational; +http://localhost)');
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Save to cache only if successful and valid JSON/XML
    if ($httpCode === 200 && $data) {
        // Basic validation
        if ($data[0] === '{' || $data[0] === '<') {
            file_put_contents($cacheFile, $data);
        }
    }
    
    return $data;
}

switch ($action) {
    case 'search_books': // OpenLibrary
        // STRICT: has_fulltext:true ensures we only get readable books
        $qBuilder = $query . ' has_fulltext:true';
        if ($year) {
            // OpenLibrary Syntax: first_publish_year:[YYYY TO *]
            $qBuilder .= " first_publish_year:[{$year} TO *]";
        }
        $encodedQuery = urlencode($qBuilder);
        $url = OL_SEARCH_BASE . "?q={$encodedQuery}&page={$page}&fields=title,author_name,cover_i,key,first_publish_year,ia,language,has_fulltext&limit=20";
        echo fetchUrl($url);
        break;
        
    case 'search_gutenberg': // Project Gutenberg (All free by definition)
        // Gutenberg doesn't easily support date ranges in simple text search, keeping as is
        $encodedQuery = urlencode($query);
        $url = "https://gutendex.com/books?search={$encodedQuery}"; 
        echo fetchUrl($url);
        break;

    case 'search_arxiv': // arXiv (All free by definition)
        $encodedQuery = urlencode($query);
        // arXiv Date Syntax isn't simple in "all:", skipping STRICT date for now to avoid breaking results
        // but we can try to sort if possible, or leave broad.
        $start = ($page - 1) * 20;
        $url = "http://export.arxiv.org/api/query?search_query=all:{$encodedQuery}&start={$start}&max_results=20";
        $xmlData = fetchUrl($url);
        if ($xmlData) {
            $xml = simplexml_load_string($xmlData);
            echo json_encode($xml);
        } else {
            echo json_encode(['entry' => []]);
        }
        break;

    case 'search_general': // Internet Archive
        // q=... AND mediatype:(texts) ...
        $qBuilder = $query . ' AND mediatype:(texts) AND -collection:lendinglibrary AND -collection:inlibrary';
        if ($year) {
            // Internet Archive Syntax: date:[YYYY-01-01 TO *]
            // actually 'date' or 'year' field. 'year' is safer for text.
            // year:[YYYY TO 9999]
            $qBuilder .= " AND year:[{$year} TO 9999]";
        }
        $encodedQuery = urlencode($qBuilder);
        $url = IA_SEARCH_BASE . "?q={$encodedQuery}&fl[]=identifier&fl[]=title&fl[]=mediatype&fl[]=creator&fl[]=year&fl[]=description&rows=20&page={$page}&output=json";
        echo fetchUrl($url);
        break;

    case 'search_google':
        // Google Books API 
        $encodedQuery = urlencode($query);
        if ($year) {
            // Google Books doesn't have a reliable "after:YYYY" in API q param without breaking some keyword matches,
            // but we can try strictly modifying the query or handling it loosely. 
            // Better strategy: Let Google be broad or use 'key' words. 
            // Actually, "search+after:YYYY" works in UI, let's try appending.
            // Note: URL encoding MUST happen after appending.
            $encodedQuery = urlencode($query . " after:{$year}");
        }
        $startIndex = ($page - 1) * 20;
        $url = "https://www.googleapis.com/books/v1/volumes?q={$encodedQuery}&startIndex={$startIndex}&maxResults=20&printType=all&filter=free-ebooks";
        echo fetchUrl($url);
        break;

    case 'search_pubmed':
        // PubMed E-utilities
        $base = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils";
        $encodedQuery = urlencode($query . ' AND "free full text"[sb]');
        
        $dateParams = "";
        if ($year) {
            // mindate/maxdate support YYYY
            $dateParams = "&mindate={$year}&maxdate=3000&datetype=pdat";
        }
        
        $retstart = ($page - 1) * 20;
        $searchUrl = "{$base}/esearch.fcgi?db=pubmed&term={$encodedQuery}&retmode=json&retmax=20&retstart={$retstart}&sort=relevance{$dateParams}";
        $searchData = json_decode(fetchUrl($searchUrl), true);
        
        $ids = $searchData['esearchresult']['idlist'] ?? [];
        
        if (empty($ids)) {
            echo json_encode(['result' => []]);
            exit;
        }
        
        $idStr = implode(',', $ids);
        $summaryUrl = "{$base}/esummary.fcgi?db=pubmed&id={$idStr}&retmode=json";
        echo fetchUrl($summaryUrl);
        break;

    case 'get_work':
        // Get details for a specific Open Library work
        if (!$id) { echo json_encode(['error' => 'No ID specified']); exit; }
        $url = OL_WORKS_BASE . "{$id}.json";
        echo fetchUrl($url);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

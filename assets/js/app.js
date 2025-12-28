/**
 * Universal Library System - Core Application Logic
 * 
 * Handles:
 * - API Communication (via proxy.php)
 * - State Management
 * - DOM Rendering
 * - Favorites (LocalStorage)
 */

class App {
    constructor() {
        this.state = {
            query: '',
            filter: 'all', // Default to all
            results: [],
            page: 1,
            isLoading: false,
            favorites: JSON.parse(localStorage.getItem('uls_favorites') || '[]'),
            view: 'home' // 'home' or 'favorites'
        };

        this.DOM = {
            grid: document.getElementById('results-grid'),
            loader: document.getElementById('loader'),
            input: document.getElementById('search-input'),
            modal: document.getElementById('modal-container'),
            modalContent: document.getElementById('modal-content'),
            favCount: document.getElementById('fav-count'),
            sentinel: document.getElementById('scroll-sentinel')
        };

        this.updateFavCount();
        this.initInfiniteScroll();
        this.suggestInitialContent();
    }

    suggestInitialContent() {
        const topics = ['Cyberpunk', 'Neuroscience', 'Ancient Rome', 'Quantum Physics', 'Renaissance', 'Stoicism', 'Mars Colonization', 'Botany'];
        const randomTopic = topics[Math.floor(Math.random() * topics.length)];

        // Silent search
        this.state.query = randomTopic;
        this.DOM.input.placeholder = `Discover: ${randomTopic}...`;
        this.search(true); // true = isAuto
    }

    initInfiniteScroll() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !this.state.isLoading && this.state.results.length > 0) {
                    this.loadMore();
                }
            });
        }, { rootMargin: '200px' }); // Load 200px before reaching bottom

        observer.observe(this.DOM.sentinel);
    }

    /**
     * Core Search Logic
     */
    async search(isAuto = false) {
        const query = isAuto ? this.state.query : this.DOM.input.value.trim();
        if (!query) return;

        this.state.query = query;
        this.state.page = 1;
        this.state.results = []; // Clear previous
        this.state.view = 'home'; // Ensure we are in home view after a search

        this.render(); // Clear UI if new search
        this.setLoading(true);

        try {
            await this.fetchResults();
        } catch (error) {
            this.showToast('Search failed. Please try again.', 'error');
            console.error(error);
        } finally {
            this.setLoading(false);
            this.render(); // Argument true means 'append' if paging, but here we reset
        }
    }

    async loadMore() {
        this.state.page++;
        this.setLoading(true);
        try {
            await this.fetchResults();
        } catch (error) {
            this.showToast('Could not load more results.', 'error');
        } finally {
            this.setLoading(false);
            this.render(true); // Append
        }
    }

    async fetchResults() {
        if (this.state.filter === 'all') {
            const sources = [
                'search_google',
                'search_books',
                'search_gutenberg',
                'search_arxiv',
                'search_medical' // Note: 'search_medical' maps to 'medical' endpoint logic in proxy but we need to match proxy case or handle it here. 
                // Actually proxy has 'search_pubmed'.
            ];

            // We'll perform parallel requests to get a mix
            // We map internal source names to proxy actions
            const actions = ['search_google', 'search_books', 'search_gutenberg', 'search_arxiv', 'search_pubmed'];

            const promises = actions.map(action =>
                fetch(`api/proxy.php?action=${action}&q=${encodeURIComponent(this.state.query)}&page=${this.state.page}`)
                    .then(r => r.ok ? r.json() : null)
                    .catch(() => null)
                    .then(data => ({ action, data }))
            );

            const results = await Promise.all(promises);

            let combinedCheck = [];

            results.forEach(({ action, data }) => {
                if (!data) return;
                // Normalize using our existing logic (duplicated slightly for speed, or we could refactor normalization into a method)
                // To keep it clean, let's call a normalizer method
                let items = [];
                // We fake the filter state temporarily or pass it
                if (action === 'search_books') items = this.normalizeResults(data, 'books');
                else if (action === 'search_google') items = this.normalizeResults(data, 'google');
                else if (action === 'search_gutenberg') items = this.normalizeResults(data, 'gutenberg');
                else if (action === 'search_arxiv') items = this.normalizeResults(data, 'arxiv');
                else if (action === 'search_pubmed') items = this.normalizeResults(data, 'medical');

                combinedCheck = [...combinedCheck, ...items];
            });

            // Shuffle for "Discovery" feel? Or sort by year?
            // Let's just shuffle to give equal visibility
            combinedCheck.sort(() => Math.random() - 0.5);

            if (this.state.page === 1) {
                this.state.results = combinedCheck;
                if (this.state.query) this.injectExternalPortals();
            } else {
                this.state.results = [...this.state.results, ...combinedCheck];
            }
            return;
        }

        // Single Source Logic
        let endpoint = '';
        switch (this.state.filter) {
            case 'books': endpoint = 'search_books'; break;
            case 'general': endpoint = 'search_general'; break;
            case 'medical': endpoint = 'search_pubmed'; break;
            case 'google': endpoint = 'search_google'; break;
            case 'gutenberg': endpoint = 'search_gutenberg'; break;
            case 'arxiv': endpoint = 'search_arxiv'; break;
        }

        const response = await fetch(`api/proxy.php?action=${endpoint}&q=${encodeURIComponent(this.state.query)}&page=${this.state.page}`);
        if (!response.ok) throw new Error('API Error');
        const data = await response.json();

        const newResults = this.normalizeResults(data, this.state.filter);

        if (this.state.page === 1) {
            this.state.results = newResults;
            if (this.state.query) this.injectExternalPortals();
        }
        else this.state.results = [...this.state.results, ...newResults];
    }

    normalizeResults(data, type) {
        if (!data) return [];
        if (type === 'books') {
            return (data.docs || []).map(doc => ({
                id: doc.key,
                title: doc.title,
                author: doc.author_name ? doc.author_name[0] : 'Unknown',
                year: doc.first_publish_year,
                cover_id: doc.cover_i,
                source: 'OL',
                ia_id: doc.ia ? doc.ia[0] : null,
                description: null // OL search doesn't return description
            }));
        } else if (type === 'general') {
            return (data.response?.docs || []).map(doc => ({
                id: doc.identifier,
                title: doc.title,
                author: doc.creator || 'Unknown',
                year: doc.year,
                cover_id: null,
                source: 'IA',
                type: doc.mediatype,
                description: doc.description // IA sometimes has it
            }));
        } else if (type === 'google') {
            return (data.items || []).map(item => ({
                id: item.id,
                title: item.volumeInfo.title,
                author: item.volumeInfo.authors ? item.volumeInfo.authors[0] : 'Unknown',
                year: item.volumeInfo.publishedDate ? item.volumeInfo.publishedDate.substring(0, 4) : '',
                cover_url: item.volumeInfo.imageLinks?.thumbnail?.replace('http:', 'https:'),
                source: 'GB',
                link: item.volumeInfo.infoLink,
                preview: item.volumeInfo.previewLink,
                description: item.volumeInfo.description
            }));
        } else if (type === 'medical') {
            const result = data.result || {};
            const uids = result.uids || [];
            return uids.map(id => {
                const doc = result[id];
                return {
                    id: id,
                    title: doc.title,
                    author: doc.authors ? doc.authors.map(a => a.name).join(', ') : 'Unknown',
                    year: doc.pubdate ? doc.pubdate.substring(0, 4) : '',
                    source: 'PM',
                    journal: doc.source,
                    description: null // PubMed summary often requires separate fetch
                };
            });
        } else if (type === 'gutenberg') {
            return (data.results || []).map(book => ({
                id: book.id,
                title: book.title,
                author: book.authors[0]?.name || 'Unknown',
                year: '',
                source: 'PG',
                cover_url: book.formats['image/jpeg'],
                formats: book.formats,
                description: null
            }));
        } else if (type === 'arxiv') {
            const entries = Array.isArray(data.entry) ? data.entry : [data.entry].filter(Boolean);
            return entries.map(entry => ({
                id: entry.id,
                title: entry.title,
                author: entry.author ? (Array.isArray(entry.author) ? entry.author[0].name : entry.author.name) : 'Researcher',
                year: entry.published ? entry.published.substring(0, 4) : '',
                source: 'AX',
                summary: entry.summary,
                description: entry.summary // Map summary to description
            }));
        }
        return [];
    }

    injectExternalPortals() {
        const q = encodeURIComponent(this.state.query);
        const portals = [
            { name: 'JSTOR', url: `https://www.jstor.org/action/doBasicSearch?Query=${q}&access=open`, icon: 'book', color: 'bg-red-600' },
            { name: 'DOAJ', url: `https://doaj.org/search/articles?ref=homepage-box&source=%7B%22query%22%3A%7B%22query_string%22%3A%7B%22query%22%3A%22${q}%22%2C%22default_operator%22%3A%22AND%22%7D%7D%7D`, icon: 'file-text', color: 'bg-orange-500' },
            { name: 'NASA', url: `https://images.nasa.gov/search-results?q=${q}`, icon: 'rocket', color: 'bg-blue-600' },
            { name: 'LibriVox', url: `https://librivox.org/search?q=${q}&search_form=advanced`, icon: 'headphones', color: 'bg-green-600' },
            { name: 'Standard Ebooks', url: `https://standardebooks.org/ebooks?q=${q}`, icon: 'book-open', color: 'bg-emerald-600' },
            { name: 'Europeana', url: `https://www.europeana.eu/en/search?page=1&q=${q}`, icon: 'globe', color: 'bg-yellow-600' },
            { name: 'DPLA', url: `https://dp.la/search?q=${q}`, icon: 'landmark', color: 'bg-purple-600' },
            { name: 'Smithsonian', url: `https://www.si.edu/search/collection-images?edan_q=${q}`, icon: 'museum', color: 'bg-blue-800' }
        ];

        // Load User Custom Portals
        const customPortals = JSON.parse(localStorage.getItem('akashic_custom_portals') || '[]');

        const allPortals = [...customPortals, ...portals];

        // We wrap these in a special result format to inject them into the grid
        const portalCards = allPortals.map(p => {
            // Replace placeholder in user custom URL
            const finalUrl = p.url.replace('{q}', q);
            return {
                isPortal: true,
                title: `Search on ${p.name}`,
                author: 'External Archive',
                source: 'EXT',
                url: finalUrl,
                color: p.color || 'bg-gray-800',
                icon: p.icon || 'link'
            };
        });

        this.state.results = [...this.state.results, ...portalCards];
    }

    addCustomPortal() {
        const name = prompt("Enter source name (e.g., 'My Uni Library'):");
        if (!name) return;

        const urlExample = "https://example.com/search?q={q}";
        const url = prompt(`Enter search URL (use {q} for query):\nExample: ${urlExample}`);
        if (!url) return;

        const customPortals = JSON.parse(localStorage.getItem('akashic_custom_portals') || '[]');
        customPortals.unshift({ // Add to top
            name: name,
            url: url,
            icon: 'globe', // Default icon
            color: 'bg-gray-700' // Default color
        });

        localStorage.setItem('akashic_custom_portals', JSON.stringify(customPortals));
        this.showToast('Custom Source Added!', 'success');

        // Refresh if showing results
        if (this.state.results.length > 0) this.search();
    }

    setFilter(type) {
        this.state.filter = type;

        // Update UI Tabs
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.dataset.type === type) {
                btn.classList.add('bg-ios-blue', 'text-white');
                btn.classList.remove('bg-white', 'text-gray-500');
            } else {
                btn.classList.remove('bg-ios-blue', 'text-white');
                btn.classList.add('bg-white', 'text-gray-500');
            }
        });

        if (this.state.query) this.search();
    }

    setLoading(bool) {
        this.state.isLoading = bool;
        // Don't hide grid if piling on pages
        if (bool && this.state.page === 1) {
            this.DOM.grid.classList.add('hidden');
            this.DOM.loader.classList.remove('hidden');
        } else {
            this.DOM.grid.classList.remove('hidden');
            this.DOM.loader.classList.add('hidden');
        }

        // Show sentinel loader if passing page 1
        if (bool && this.state.page > 1) {
            this.DOM.sentinel.classList.remove('opacity-0');
        } else {
            this.DOM.sentinel.classList.add('opacity-0');
        }
    }

    toggleFavoritesView() {
        if (this.state.view === 'favorites') {
            this.state.view = 'home';
            this.render();
            // restore search if exists, else welcome?
        } else {
            this.state.view = 'favorites';
            this.render();
        }
    }

    /**
     * Rendering Logic
     */
    render(append = false) {
        if (!append) this.DOM.grid.innerHTML = '';

        let itemsToRender = this.state.results;

        if (this.state.view === 'favorites') {
            itemsToRender = this.state.favorites.map(f => ({
                id: f.id,
                title: f.title,
                author: 'Saved Item',
                year: '',
                source: f.id.startsWith('/works') ? 'OL' : 'IA', // heuristic
                cover_id: null // Note: we assume no cover stored to save space, will use placeholder or fetch if we wanted
            }));
            // For favorites we might want to store more metadata or re-fetch. 
            // To keep it simple/stateless, we just show the title.
            this.DOM.sentinel.classList.add('hidden');
        } else {
            // Show load more if we have results
            if (this.state.results.length > 0) this.DOM.sentinel.classList.remove('hidden');
            else this.DOM.sentinel.classList.add('hidden');
        }

        if (itemsToRender.length === 0 && !this.state.isLoading) {
            if (this.state.view === 'favorites') {
                this.DOM.grid.innerHTML = `<div class="col-span-full text-center text-gray-400 mt-10">No favorites yet. Go explore!</div>`;
                this.DOM.sentinel.classList.add('hidden');
            } else if (this.state.query) {
                this.DOM.grid.innerHTML = `<div class="col-span-full text-center text-gray-400 mt-10">No results found.</div>`;
                this.DOM.sentinel.classList.add('hidden');
            }
            return;
        }

        // If appending, we only want to render the NEW items? 
        // Or just re-render all? Re-rendering all is easier but slower. 
        // Let's just render all for simplicity in this stateless app, 
        // DOM diffing would be better but vanilla JS means...
        if (append) {
            // Calculate start index
            // Actually, simplest 'append' logic without complex state tracking:
            // just clear and re-render all OR only render the slice.
            // We will re-render all to be safe against duplicates.
            this.DOM.grid.innerHTML = '';
        }

        itemsToRender.forEach(item => {
            const card = document.createElement('div');

            // Check for Portal Card
            if (item.isPortal) {
                card.className = `${item.color} rounded-2xl overflow-hidden hover-lift cursor-pointer group flex flex-col items-center justify-center p-6 text-center text-white min-h-[300px]`;
                card.onclick = () => window.open(item.url, '_blank');
                card.innerHTML = `
                    <div class="bg-white/20 p-4 rounded-full mb-4 group-hover:bg-white/30 transition-colors">
                        <i data-lucide="${item.icon}" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">${item.title}</h3>
                    <p class="text-white/80 text-sm">Direct Redirect</p>
                    <div class="mt-6 px-4 py-2 bg-white/20 rounded-lg text-sm font-semibold group-hover:bg-white group-hover:text-gray-900 transition-colors">
                        Click to Open
                    </div>
                `;
                this.DOM.grid.appendChild(card);
                lucide.createIcons();
                return;
            }

            card.className = 'glass rounded-2xl overflow-hidden hover-lift cursor-pointer group flex flex-col';
            card.onclick = () => this.openDetail(item);

            // Image Handler
            let imgUrl = 'assets/img/placeholder.png'; // Need a placeholder
            if (item.source === 'OL' && item.cover_id) {
                imgUrl = `https://covers.openlibrary.org/b/id/${item.cover_id}-L.jpg`;
            } else if (item.source === 'IA') {
                imgUrl = `https://archive.org/services/img/${item.id}`;
            } else if (item.source === 'GB' && item.cover_url) {
                imgUrl = item.cover_url;
            } else if (item.source === 'PM') {
                imgUrl = 'https://placehold.co/400x600/2563eb/FFF?text=PubMed'; // Distinct placeholder
            } else if (item.source === 'PG') {
                imgUrl = item.cover_url || 'https://placehold.co/400x600/10b981/FFF?text=Gutenberg';
            } else if (item.source === 'AX') {
                imgUrl = 'https://placehold.co/400x600/ef4444/FFF?text=arXiv+Science';
            }

            // Fallback for image loading error
            const imgEl = document.createElement('img');
            imgEl.src = imgUrl;
            imgEl.loading = 'lazy'; // Native Lazy Loading
            imgEl.className = 'w-full aspect-[2/3] object-cover bg-gray-200 transition-opacity duration-300';
            imgEl.onerror = function () { this.src = 'https://placehold.co/400x600?text=No+Cover'; };

            card.innerHTML = `
                <div class="relative overflow-hidden w-full aspect-[2/3]">
                    ${imgEl.outerHTML}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                        <span class="text-white font-medium text-sm">Tap to View</span>
                    </div>
                </div>
                <div class="p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 line-clamp-2 leading-tight mb-1">${item.title}</h3>
                        <p class="text-sm text-gray-500 line-clamp-1">${item.author}</p>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-1 rounded">${item.year || 'N/A'}</span>
                        <span class="text-xs uppercase tracking-wider text-gray-400 font-bold">${item.source}</span>
                    </div>
                </div>
            `;
            this.DOM.grid.appendChild(card);
        });
    }

    /**
     * Citation Logic
     */
    generateCitation(item, format, url) {
        const author = item.author || 'Unknown Author';
        const title = item.title || 'Untitled Work';
        const year = item.year || 'n.d.';

        if (format === 'APA') {
            return `${author}. (${year}). ${title}. Retrieved from ${url}`;
        } else if (format === 'MLA') {
            return `${author}. "${title}." ${item.source === 'OL' ? 'Open Library' : item.source}, ${year}, ${url}.`;
        }
        return '';
    }

    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            this.showToast('Citation copied!', 'success');
        }).catch(() => this.showToast('Failed to copy', 'error'));
    }

    /**
     * Detail Modal Logic
     */
    openDetail(item) {
        const modal = this.DOM.modal;
        const content = this.DOM.modalContent;

        modal.classList.remove('hidden');

        // Image
        let imgUrl = 'https://placehold.co/400x600?text=No+Cover';
        if (item.source === 'OL' && item.cover_id) imgUrl = `https://covers.openlibrary.org/b/id/${item.cover_id}-L.jpg`;
        else if (item.source === 'IA') imgUrl = `https://archive.org/services/img/${item.id}`;
        else if (item.source === 'GB' && item.cover_url) imgUrl = item.cover_url;
        else if (item.source === 'PM') imgUrl = 'https://placehold.co/400x600/2563eb/FFF?text=Medical+Paper';
        else if (item.source === 'PG') imgUrl = item.cover_url || 'https://placehold.co/400x600/10b981/FFF?text=Gutenberg';
        else if (item.source === 'AX') imgUrl = 'https://placehold.co/400x600/ef4444/FFF?text=arXiv+Science';

        // Construct Links
        let readLink = '#';
        let downloadLink = '#';
        let sourceName = 'Unknown Source';

        if (item.source === 'OL') {
            sourceName = 'Open Library';
            // Open Library usually relies on Internet Archive for the actual readable scan
            if (item.ia_id) {
                // Direct to BookReader Theater Mode (Full Screen)
                readLink = `https://archive.org/details/${item.ia_id}?view=theater`;
                downloadLink = `https://archive.org/download/${item.ia_id}`;
            } else {
                // Fallback to OL page, but likely filtered out by our strict query
                readLink = `https://openlibrary.org${item.id}`;
            }
        } else if (item.source === 'IA') {
            sourceName = 'Internet Archive';
            // Direct to BookReader Theater Mode
            readLink = `https://archive.org/details/${item.id}?view=theater`;
            downloadLink = `https://archive.org/download/${item.id}`;
        } else if (item.source === 'GB') {
            sourceName = 'Google Books';
            readLink = item.link; // Google's reader link
            downloadLink = item.preview;
        } else if (item.source === 'PM') {
            sourceName = 'PubMed Central';
            readLink = `https://pubmed.ncbi.nlm.nih.gov/${item.id}/`;
            downloadLink = `https://www.ncbi.nlm.nih.gov/pmc/articles/pmid/${item.id}/`;
        } else if (item.source === 'PG') {
            sourceName = 'Project Gutenberg';
            readLink = `https://www.gutenberg.org/ebooks/${item.id}`;
            downloadLink = item.formats['application/epub+zip'] || readLink;
        } else if (item.source === 'AX') {
            sourceName = 'arXiv.org';
            // Direct PDF link for arXiv
            readLink = item.id.replace('abs', 'pdf') + '.pdf';
            downloadLink = readLink;
        }

        const isFav = this.isFavorite(item.id);
        const apa = this.generateCitation(item, 'APA', readLink);
        const mla = this.generateCitation(item, 'MLA', readLink);

        content.innerHTML = `
            <!-- Left: Image -->
            <div class="w-full md:w-1/3 flex-shrink-0">
                <img src="${imgUrl}" class="w-full rounded-2xl shadow-xl object-cover aspect-[2/3] bg-gray-100">
            </div>

            <!-- Right: Info -->
            <div class="flex-grow pt-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">${item.title}</h2>
                        <p class="text-xl text-gray-500 font-medium">${item.author}</p>
                    </div>
                    <button onclick="app.toggleFavorite('${item.id}', '${encodeURIComponent(item.title)}')" 
                        class="p-3 rounded-full ${isFav ? 'bg-red-50 text-red-500' : 'bg-gray-100 text-gray-400'} hover:bg-gray-200 transition-colors">
                        <i data-lucide="heart" class="w-6 h-6 ${isFav ? 'fill-current' : ''}"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-4 mb-6 text-sm text-gray-600">
                    <span class="px-3 py-1 bg-gray-100 rounded-lg">Year: ${item.year || 'Unknown'}</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-lg">Source: ${sourceName}</span>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="${readLink}" target="_blank" class="flex-1 bg-ios-blue text-white py-4 rounded-xl font-semibold text-center hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        Read / View Now
                    </a>
                    ${item.source !== 'PM' ? `
                    <a href="${downloadLink}" target="_blank" class="flex-1 bg-white border border-gray-200 text-gray-900 py-4 rounded-xl font-semibold text-center hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                        ${item.source === 'GB' ? 'Preview' : 'Download/Source'}
                    </a>` : ''}
                </div>

                <!-- Citation Box -->
                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                             <i data-lucide="quote" class="w-3 h-3"></i> Cite this work (APA)
                        </h4>
                        <button onclick="app.copyToClipboard('${apa.replace(/'/g, "\\'")}')" class="text-xs font-bold text-ios-blue hover:text-blue-700 flex items-center gap-1">
                            <i data-lucide="copy" class="w-3 h-3"></i> Copy
                        </button>
                    </div>
                    <p class="text-sm text-gray-700 font-mono bg-white p-3 rounded-lg border border-gray-200 select-all mb-4 leading-relaxed break-words">${apa}</p>
                    
                     <div class="flex justify-between items-center mb-2">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                             MLA Format
                        </h4>
                        <button onclick="app.copyToClipboard('${mla.replace(/'/g, "\\'")}')" class="text-xs font-bold text-ios-blue hover:text-blue-700 flex items-center gap-1">
                            <i data-lucide="copy" class="w-3 h-3"></i> Copy
                        </button>
                    </div>
                    <p class="text-sm text-gray-700 font-mono bg-white p-3 rounded-lg border border-gray-200 select-all leading-relaxed break-words">${mla}</p>
                </div>

                ${item.description ? `
                <div class="mb-8">
                     <h4 class="text-lg font-bold text-gray-900 mb-2">Description / Abstract</h4>
                     <p class="text-gray-600 leading-relaxed text-sm">${item.description}</p>
                </div>
                ` : `
                <p class="text-gray-600 leading-relaxed mb-8">
                    To view this content, you can access it directly from the ${sourceName} servers.
                    We act as a gateway to these public resources to ensure you get the exact document.
                </p>`}
            </div>
        `;

        lucide.createIcons();
    }

    closeModal() {
        this.DOM.modal.classList.add('hidden');
    }

    /**
     * Favorites
     */
    isFavorite(id) {
        return this.state.favorites.some(f => f.id === id);
    }

    toggleFavorite(id, titleEncoded) {
        const title = decodeURIComponent(titleEncoded);
        const modalBtnIcon = document.querySelector('#modal-content button i');

        if (this.isFavorite(id)) {
            this.state.favorites = this.state.favorites.filter(f => f.id !== id);
        } else {
            this.state.favorites.push({ id, title, timestamp: Date.now() });
            // Add bounce effect to modal button if visible
            if (modalBtnIcon) modalBtnIcon.parentElement.classList.add('animate-heart');
            setTimeout(() => modalBtnIcon?.parentElement.classList.remove('animate-heart'), 400); // cleanup
        }
        localStorage.setItem('uls_favorites', JSON.stringify(this.state.favorites));
        this.updateFavCount();

        // Re-render modal button if open
        if (modalBtnIcon) {
            if (this.isFavorite(id)) {
                modalBtnIcon.parentElement.classList.add('bg-red-50', 'text-red-500');
                modalBtnIcon.parentElement.classList.remove('bg-gray-100', 'text-gray-400');
                modalBtnIcon.classList.add('fill-current');
            } else {
                modalBtnIcon.parentElement.classList.remove('bg-red-50', 'text-red-500');
                modalBtnIcon.parentElement.classList.add('bg-gray-100', 'text-gray-400');
                modalBtnIcon.classList.remove('fill-current');
            }
        }
    }

    updateFavCount() {
        const count = this.state.favorites.length;
        const el = this.DOM.favCount;
        el.textContent = count;
        if (count > 0) el.classList.remove('opacity-0');
        else el.classList.add('opacity-0');
    }

    goHome() {
        this.state.view = 'home';
        this.state.query = '';
        this.DOM.input.value = '';
        this.state.results = [];
        this.DOM.grid.innerHTML = '';
        // Reset sentinel
        this.DOM.sentinel.classList.add('hidden');
    }

    showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-full text-white font-medium shadow-lg z-50 animate-enter ${type === 'error' ? 'bg-red-500' : 'bg-gray-800'}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
}

// Init
const app = new App();

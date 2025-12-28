<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal & Terms - Akashic Library</title>
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { ios: { blue: '#007AFF', gray: '#8E8E93', bg: '#F2F2F7' } },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased min-h-screen flex flex-col bg-[#F2F2F7] text-gray-900">

    <!-- Nav -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/20">
        <div class="max-w-4xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="index.php" class="flex items-center space-x-2 text-gray-900 hover:opacity-70 transition-opacity">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span class="font-semibold">Back to Library</span>
            </a>
            <div class="font-bold text-lg tracking-tight">Legal & Terms</div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow pt-28 pb-20 px-4 sm:px-6">
        <div class="max-w-3xl mx-auto space-y-8">

            <!-- Card 1: Terms of Service -->
            <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-ios-blue">
                    <i data-lucide="scale" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Terms of Service</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p><strong>1. Acceptance of Terms</strong><br>By accessing the Akashic Library (the "Service"), you agree to comply with these Terms of Service. If you do not agree, you must not use the Service.</p>
                    
                    <p><strong>2. Nature of Service</strong><br>The Akashic Library is strictly a <strong>metadata search engine and viewer</strong>. We do not host, upload, or store books, articles, or papers. All content is dynamically fetched from third-party public APIs (Internet Archive, Open Library, PubMed, etc.).</p>
                    
                    <p><strong>3. User Responsibility</strong><br>You agree to use this Service only for lawful purposes, such as education, research, and personal learning. You must not use this tool to infringe upon copyrights or violate the laws of your jurisdiction.</p>
                </div>
            </section>

            <!-- Card 2: Copyright & DMCA -->
            <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-red-600">
                    <i data-lucide="shield-alert" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Copyright & DMCA</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p><strong>1. Information Location Tool (Safe Harbor)</strong><br>The Akashic Library operates as an "Information Location Tool" under the Digital Millennium Copyright Act (17 U.S.C. § 512(d)). We do not host, store, or transmit copyrighted files. We index metadata and provide links to third-party public repositories.</p>
                    
                    <p><strong>2. Third-Party Liability</strong><br>Content accessed via this tool is hosted by external organizations (e.g., Internet Archive, National Institutes of Health). Providing a link to these resources does not imply endorsement or ownership. Takedown requests for the underlying file must be directed to the hosting site.</p>
                    
                    <p><strong>3. Takedown Procedure</strong><br>If you believe a link in our search index facilitates infringement of your valid copyright, you may send a notice to our Designated Agent at <strong>legal@akashic-record.app</strong>. Upon receipt of a valid notice, we will disable the specific link from our search results. Note that this does not remove the content from the source repository.</p>
                </div>
            </section>

            <!-- Card 3: Privacy Policy -->
            <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-green-600">
                    <i data-lucide="lock" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Privacy Policy</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p><strong>1. Data Collection</strong><br>We operate on a "Stateless" principle. We do not require account registration. We do not track your search history on our servers. Your "Favorites" are stored locally on your own device via LocalStorage.</p>
                    
                    <p><strong>2. API Usage</strong><br>When you perform a search, your query is sent to our proxy to fetch results from external providers (e.g., Google Books, PubMed). These providers may see your query IP address as part of the connection request. Please review their respective privacy policies.</p>
                </div>
            </section>

            <!-- Card 4: Disclaimer -->
            <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-orange-500">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Disclaimer</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND. The developers of Akashic Library are not reliable for any damages, legal issues, or data loss arising from the use of this software.</p>
                    <p>This project is open-source and intended for educational demonstration of API integration and Library Sciences.</p>
                </div>
            </section>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-gray-400 text-sm pb-10">
        <p>&copy; 2025 Akashic Library. All Rights Reserved.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

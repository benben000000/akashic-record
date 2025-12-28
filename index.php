<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akashic Library | Universal Open Knowledge</title>
    <meta name="description" content="Direct, unrestricted access to the world's knowledge. Search millions of free books, papers, and scientific articles from Google Books, Open Library, PubMed, arXiv, and Gutenberg.">
    <meta name="keywords" content="books, library, open access, pdf, research, free books, pubmed, arxiv, gutenberg">
    <meta name="theme-color" content="#007AFF">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for simplicity as requested) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ios: {
                            blue: '#007AFF',
                            gray: '#8E8E93',
                            bg: '#F2F2F7'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased min-h-screen flex flex-col">

    <!-- Navigation (Glass Header) -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/20 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2 cursor-pointer" onclick="app.goHome()">
                    <div class="w-8 h-8 bg-ios-blue rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <i data-lucide="infinity" class="w-5 h-5"></i>
                    </div>
                    <span class="font-semibold text-lg tracking-tight">Akashic Library</span>
                </div>
                
                <!-- Nav Links -->
                <div class="flex items-center space-x-6">
                    <button onclick="app.toggleFavoritesView()" class="text-ios-gray hover:text-ios-blue transition-colors relative">
                        <i data-lucide="bookmark" class="w-5 h-5"></i>
                        <span id="fav-count" class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center opacity-0 transition-opacity">0</span>
                    </button>
                    <!-- Settings / Profile Placeholder -->
                    <button class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden hover:ring-2 hover:ring-ios-blue transition-all">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="User">
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow pt-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full relative">
        
        <!-- View: Home / Search -->
        <section id="view-home">
            <!-- Hero Search -->
            <div class="text-center max-w-2xl mx-auto mt-10 mb-16">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600">
                    The Akashic Records
                </h1>
                <p class="text-ios-gray text-lg mb-8">
                    Direct, unrestricted access to the world's knowledge.
                </p>
                
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="search" class="text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" id="search-input" 
                        class="search-input w-full pl-12 pr-4 py-4 rounded-2xl text-lg outline-none placeholder-gray-400"
                        placeholder="Search the infinite library..."
                        onkeydown="if(event.key === 'Enter') app.search()">
                    
                    <button onclick="app.search()" class="absolute right-2 top-2 bg-ios-blue text-white p-2 rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/20">
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap justify-center gap-2 mt-6 max-w-3xl mx-auto">
                    <button onclick="app.setFilter('all')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-ios-blue text-white shadow-md transition-all active-filter" data-type="all">All Sources</button>
                    <button onclick="app.setFilter('books')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="books">Library</button>
                    <button onclick="app.setFilter('google')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="google">Google Books</button>
                    <button onclick="app.setFilter('gutenberg')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="gutenberg">Gutenberg</button>
                    <button onclick="app.setFilter('medical')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="medical">Medical</button>
                    <button onclick="app.setFilter('arxiv')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="arxiv">Science</button>
                    <button onclick="app.setFilter('general')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-500 hover:bg-gray-100 transition-all" data-type="general">Archive (Raw)</button>
                    <!-- Custom Link Button -->
                    <button onclick="app.addCustomPortal()" class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all flex items-center gap-1" title="Add Custom Source">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
                
                <!-- Legal Links Row -->
                <div class="flex justify-center space-x-6 mt-4 text-[10px] text-gray-400 font-medium uppercase tracking-widest opacity-80 hover:opacity-100 transition-opacity">
                    <a href="legal.php" class="hover:text-ios-blue transition-colors">Terms</a>
                    <span>•</span>
                    <a href="legal.php" class="hover:text-ios-blue transition-colors">Privacy</a>
                    <span>•</span>
                    <a href="legal.php" class="hover:text-ios-blue transition-colors">DMCA / Copyright</a>
                </div>
            </div>

            <!-- Results Grid -->
            <div id="results-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pb-10">
                <!-- JS will inject cards here -->
            </div>
            
            <!-- Infinite Scroll Sentinel -->
            <div id="scroll-sentinel" class="w-full h-20 flex items-center justify-center opacity-0 transition-opacity">
                <span class="text-gray-400 text-sm">Loading more knowledge...</span>
            </div>

            <!-- Loading State (Initial) -->
            <div id="loader" class="hidden grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Skeletons -->
                <div class="aspect-[2/3] rounded-2xl skeleton"></div>
                <div class="aspect-[2/3] rounded-2xl skeleton"></div>
                <div class="aspect-[2/3] rounded-2xl skeleton"></div>
                <div class="aspect-[2/3] rounded-2xl skeleton"></div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center text-gray-400 text-sm pb-8 pt-10 border-t border-gray-200/50 mt-10">
            <p>&copy; 2025 Akashic Library. Knowledge for All.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="legal.php" class="hover:text-ios-blue transition-colors">Legal & Terms</a>
                <span class="text-gray-300">|</span>
                <a href="https://archive.org/about/" target="_blank" class="hover:text-ios-blue transition-colors">About Internet Archive</a>
            </div>
        </footer>

        <!-- View: Detail Modal (Overlay) -->
        <div id="modal-container" class="fixed inset-0 z-[60] hidden flex items-center justify-center px-4">
            <div class="absolute inset-0 bg-black/20 backdrop-blur-sm" onclick="app.closeModal()"></div>
            
            <div class="glass-panel w-full max-w-4xl max-h-[90vh] h-auto relative flex flex-col overflow-hidden animate-enter transition-transform">
                <!-- Close Button -->
                <button onclick="app.closeModal()" class="absolute top-4 right-4 z-10 p-2 bg-white/50 hover:bg-white rounded-full transition-colors backdrop-blur-md">
                    <i data-lucide="x" class="w-5 h-5 text-gray-800"></i>
                </button>

                <!-- Content -->
                <div id="modal-content" class="w-full h-full overflow-y-auto p-8 flex flex-col md:flex-row gap-8">
                    <!-- Injected by JS -->
                </div>
            </div>
        </div>

    </main>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>

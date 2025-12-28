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
                    
                    <p><strong>4. Non-Commercial / Non-Profit Status</strong><br>The Akashic Library is a strictly <strong>non-commercial, non-profit</strong> open-source initiative. We generate <strong>zero revenue</strong> from this service. There are no advertisements, subscriptions, or paywalls. The tool is provided solely as a public utility for educational advancement and easier access to potential knowledge.</p>
                </div>
            </section>

            <!-- Card 2: Copyright & DMCA -->
            <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-red-600">
                    <i data-lucide="shield-alert" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Intellectual Property (International & RA 8293)</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p><strong>1. Information Location Tool</strong><br>The Akashic Library operates as a search engine and finder, compliant with the <strong>Intellectual Property Code of the Philippines (Republic Act No. 8293)</strong> and the <strong>Electronic Commerce Act of 2000 (Republic Act No. 8792)</strong>. We also align our policies with international standards, including the <strong>Berne Convention</strong> and the <strong>WIPO Copyright Treaty</strong>. We do not host, store, or transmit copyrighted files. We index metadata and provide links to third-party public repositories.</p>
                    
                    <p><strong>2. Third-Party Liability</strong><br>Content accessed via this tool is hosted by external organizations (e.g., Internet Archive, National Institutes of Health). Providing a link to these resources does not imply endorsement or ownership. Takedown requests for the underlying file must be directed to the hosting site.</p>
                    
                    <p><strong>3. Takedown Procedure</strong><br>If you believe a link in our search index facilitates infringement of your valid copyright, you may send a notice to our Designated Agent at <strong>job.benedictgarcia@outlook.com</strong>. Upon receipt of a valid notice, we will disable the specific link from our search results.</p>
                </div>
            </section>

<!-- ... (skipping unchanged sections) ... -->

            <!-- Card 5: General Provisions -->
             <section class="glass-panel p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6 text-gray-500">
                    <i data-lucide="file-text" class="w-6 h-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900">General Provisions</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 space-y-4 leading-relaxed">
                    <p><strong>1. Governing Law & Exclusive Jurisdiction</strong><br>These Terms shall be governed by the laws of the <strong>Republic of the Philippines</strong>. You agree that any legal action or proceeding relating to the Service shall be instituted <strong>exclusively</strong> in the courts of the Philippines. You explicitly waive any right to bring a lawsuit in any other jurisdiction.</p>
                    
                    <p><strong>2. Severability</strong><br>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary so that these Terms will otherwise remain in full force and effect.</p>
                    
                    <p><strong>3. Changes to Terms</strong><br>We reserve the right to modify these terms at any time. Your continued use of the Service constitutes agreement to the updated terms.</p>
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

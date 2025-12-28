<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Fortress - Akashic Library</title>
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
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    typography: (theme) => ({
                        DEFAULT: {
                            css: {
                                h1: { color: theme('colors.gray.900'), fontWeight: '800' },
                                h2: { color: theme('colors.gray.900'), fontWeight: '700', marginTop: '2em' },
                                strong: { color: theme('colors.gray.900') },
                                a: { color: theme('colors.blue.600'), textDecoration: 'none', '&:hover': { textDecoration: 'underline' } },
                            },
                        },
                    }),
                }
            },
            plugins: [
                function({ addComponents }) {
                    addComponents({
                        '.glass': {
                            backgroundColor: 'rgba(255, 255, 255, 0.7)',
                            backdropFilter: 'blur(20px)',
                            WebkitBackdropFilter: 'blur(20px)',
                        },
                        '.glass-panel': {
                            backgroundColor: 'rgba(255, 255, 255, 0.8)',
                            backdropFilter: 'blur(20px)',
                            WebkitBackdropFilter: 'blur(20px)',
                            borderRadius: '1.5rem',
                            border: '1px solid rgba(255, 255, 255, 0.5)',
                            boxShadow: '0 8px 32px rgba(0, 0, 0, 0.05)',
                        }
                    })
                }
            ]
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased min-h-screen flex flex-col bg-[#F2F2F7] text-gray-900 scroll-smooth">

    <!-- Nav -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/20">
        <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="index.php" class="flex items-center space-x-2 text-gray-900 hover:opacity-70 transition-opacity">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span class="font-semibold">Back to Library</span>
            </a>
            <div class="font-bold text-lg tracking-tight hidden sm:block">Legal & Compliance Fortress</div>
            <div class="sm:hidden font-bold">Legal</div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow pt-28 pb-20 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto space-y-24">
            
            <!-- Header -->
            <div class="text-center space-y-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">Legal Fortress</h1>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                    Governing documents for the Akashic Library. By using this service, you agree to these unified terms.
                    <br><span class="text-xs uppercase tracking-widest font-semibold text-gray-400 mt-2 block">Jurisdiction: Republic of the Philippines</span>
                </p>
            </div>

            <!-- Navigation Cards (Table of Contents) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#terms" class="glass-panel p-6 text-center hover:scale-[1.02] transition-transform">
                    <div class="w-10 h-10 mx-auto bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3">
                        <i data-lucide="scale" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-sm text-gray-900">Terms</span>
                </a>
                <a href="#privacy" class="glass-panel p-6 text-center hover:scale-[1.02] transition-transform">
                    <div class="w-10 h-10 mx-auto bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-3">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-sm text-gray-900">Privacy</span>
                </a>
                <a href="#dmca" class="glass-panel p-6 text-center hover:scale-[1.02] transition-transform">
                    <div class="w-10 h-10 mx-auto bg-red-100 text-red-600 rounded-lg flex items-center justify-center mb-3">
                        <i data-lucide="shield-alert" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-sm text-gray-900">IP / DMCA</span>
                </a>
                <a href="#disclaimer" class="glass-panel p-6 text-center hover:scale-[1.02] transition-transform">
                    <div class="w-10 h-10 mx-auto bg-orange-100 text-orange-500 rounded-lg flex items-center justify-center mb-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-sm text-gray-900">Liability</span>
                </a>
            </div>

            <!-- SECTION 1: TERMS OF SERVICE -->
            <section id="terms" class="scroll-mt-28">
                <div class="glass-panel p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-5">
                        <i data-lucide="scale" class="w-32 h-32"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4 flex items-center gap-3">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-lg"><i data-lucide="scale" class="w-6 h-6"></i></span>
                        Master Terms of Service
                    </h2>
                    
                    <div class="prose prose-gray max-w-none text-gray-600 space-y-6 leading-relaxed">
                        <p><strong>1. Introduction</strong><br>Welcome to the Akashic Library (the "Service"). By accessing or using our website, you engage in a binding contract with the Service Provider. You agree to be bound by these Terms, the Privacy Policy, and the Copyright Policy.</p>
                        
                        <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-400 text-yellow-800 text-sm font-semibold">
                            IF YOU DO NOT AGREE TO THESE TERMS, YOU ARE PROHIBITED FROM USING THIS SERVICE.
                        </div>

                        <p><strong>2. Definition of Service ("Passive Conduit")</strong><br>The Service is strictly defined as a <strong>Metadata Search Engine</strong>. Under the <strong>Electronic Commerce Act of 2000 (Republic Act No. 8792)</strong>, the Service acts as a mere conduit and is not liable for content transmitted through its system. We do not host, select, or modify the underlying files.</p>

                        <p><strong>3. User Conduct</strong><br>You agree to use this Service strictly for <strong>Personal, Non-Commercial, Educational, and Research purposes</strong>. You are prohibited from using the tool for commercial gain or to facilitate infringement.</p>

                        <p><strong>4. Governing Law & Exclusive Jurisdiction</strong><br>These Terms shall be governed by the laws of the <strong>Republic of the Philippines</strong>. You agree that any legal action shall be instituted <strong>EXCLUSIVELY</strong> in the competent courts of <strong>Quezon City, Philippines</strong>. You waive any objection to venue or jurisdiction.</p>
                        
                        <p><strong>5. International Compliance</strong><br>We comply with the <strong>Berne Convention</strong> and <strong>WIPO Copyright Treaty</strong> regarding the protection of literary works.</p>
                    </div>
                </div>
            </section>

            <!-- SECTION 2: PRIVACY POLICY -->
            <section id="privacy" class="scroll-mt-28">
                 <div class="glass-panel p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-5">
                        <i data-lucide="lock" class="w-32 h-32"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4 flex items-center gap-3">
                        <span class="bg-green-100 text-green-600 p-2 rounded-lg"><i data-lucide="lock" class="w-6 h-6"></i></span>
                        Data Sovereignty & Privacy
                    </h2>

                    <div class="prose prose-gray max-w-none text-gray-600 space-y-6 leading-relaxed">
                         <p><strong>1. "Stateless" Architecture</strong><br>We operate on a privacy-first, stateless principle. We do not maintain a user database, do not require registration, and do not store permanent search logs.</p>
                         
                         <p><strong>2. Local Storage Compatibility</strong><br>Your "Favorites" and settings are stored locally on your device using HTML5 LocalStorage. This data never leaves your browser.</p>
                         
                         <p><strong>3. RA 10173 Compliance</strong><br>In accordance with the <strong>Data Privacy Act of 2012 (RA 10173)</strong>, we acknowledge your rights to data privacy. Since we collect no personal data, your privacy is intrinsically protected.</p>
                    </div>
                </div>
            </section>

            <!-- SECTION 3: COPYRIGHT & DMCA -->
             <section id="dmca" class="scroll-mt-28">
                 <div class="glass-panel p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-5">
                        <i data-lucide="shield-alert" class="w-32 h-32"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4 flex items-center gap-3">
                        <span class="bg-red-100 text-red-600 p-2 rounded-lg"><i data-lucide="shield-alert" class="w-6 h-6"></i></span>
                        Intellectual Property & DMCA
                    </h2>

                    <div class="prose prose-gray max-w-none text-gray-600 space-y-6 leading-relaxed">
                         <p><strong>1. Safe Harbor Statement</strong><br>We operate as an <strong>"Information Location Tool"</strong> under <strong>17 U.S.C. § 512(d)</strong> (DMCA) and <strong>RA 8293</strong> (IP Code of the Philippines). We do not host or store copyrighted material.</p>
                         
                         <p><strong>2. Takedown Procedure</strong><br>Copyright holders may submit a takedown notice to our Designated Agent. Upon receipt of a valid notice, we will disable the specific link from our search index.</p>

                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mt-6">
                            <h4 class="font-bold text-gray-900 mb-2">Designated Copyright Agent</h4>
                            <div class="flex items-center space-x-2 font-mono font-semibold text-gray-800">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                <span>job.benedictgarcia@outlook.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 4: DISCLAIMER -->
             <section id="disclaimer" class="scroll-mt-28">
                 <div class="glass-panel p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-5">
                        <i data-lucide="alert-triangle" class="w-32 h-32"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4 flex items-center gap-3">
                        <span class="bg-orange-100 text-orange-500 p-2 rounded-lg"><i data-lucide="alert-triangle" class="w-6 h-6"></i></span>
                        Disclaimer & Liability
                    </h2>

                    <div class="prose prose-gray max-w-none text-gray-600 space-y-6 leading-relaxed">
                         <p><strong>1. "AS IS" WARRANTY</strong><br>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.</p>
                         
                         <p><strong>2. NON-COMMERCIAL STATUS</strong><br>The Akashic Library is an educational, non-profit open-source initiative generating <strong>ZERO REVENUE</strong>.</p>
                         
                         <p><strong>3. INDEMNIFICATION</strong><br>You agree to indemnify and hold harmless the developers from any claims or legal fees arising from your use of this Service.</p>
                         
                         <p><strong>4. SEVERABILITY</strong><br>If any provision of these Terms is found invalid, the remaining provisions shall remain in full force and effect.</p>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <div class="text-center text-gray-400 text-sm pb-10">
                <p>© 2025 Akashic Library. All Rights Reserved.</p>
                <p class="text-xs mt-1">Version 1.0.0 • Verified Legal Fortress</p>
            </div>

        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

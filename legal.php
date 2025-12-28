<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal & Compliance - Akashic Library</title>
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
            <div class="font-bold text-lg tracking-tight">Legal & Compliance Hub</div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow pt-32 pb-20 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">
            
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Legal Fortress</h1>
                <p class="text-gray-500 max-w-2xl mx-auto">Transparency, compliance, and protection. Explore our governing documents below.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Card 1: Terms of Service -->
                <a href="legal/terms.php" class="group glass-panel p-8 hover:scale-[1.02] transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                            <i data-lucide="scale" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Terms of Service</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">The Master Contract. Governing law, user conduct, and the "Passive Conduit" defense.</p>
                    </div>
                </a>

                <!-- Card 2: Privacy Policy -->
                <a href="legal/privacy.php" class="group glass-panel p-8 hover:scale-[1.02] transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mb-6">
                            <i data-lucide="lock" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Privacy Policy</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">Data Sovereignty (RA 10173). We are stateless and store nothing.</p>
                    </div>
                </a>

                <!-- Card 3: DMCA / Copyright -->
                <a href="legal/dmca.php" class="group glass-panel p-8 hover:scale-[1.02] transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-6">
                            <i data-lucide="shield-alert" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors">Intellectual Property</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">RA 8293 & DMCA Safe Harbor. Designated Agent and Takedown Procedures.</p>
                    </div>
                </a>

                <!-- Card 4: Disclaimer -->
                <a href="legal/disclaimer.php" class="group glass-panel p-8 hover:scale-[1.02] transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center mb-6">
                            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-500 transition-colors">Disclaimer & Liability</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">Strict "AS IS" Warranty. Indemnification and Non-Profit status.</p>
                    </div>
                </a>

            </div>

            <div class="mt-16 border-t border-gray-200 pt-8 text-center">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Jurisdiction: Republic of the Philippines</p>
                <p class="text-[10px] text-gray-300 mt-2">© 2025 Akashic Library. All Rights Reserved.</p>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

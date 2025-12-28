<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Akashic Library</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
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
</head>
<body class="bg-[#F2F2F7] text-gray-900 font-sans antialiased">
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/20">
        <div class="max-w-4xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="../legal.php" class="flex items-center space-x-2 text-gray-900 hover:opacity-70 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                <span class="font-semibold">Back to Legal Hub</span>
            </a>
            <div class="font-bold text-lg tracking-tight">Terms of Service</div>
        </div>
    </nav>

    <main class="pt-28 pb-20 px-6 max-w-4xl mx-auto">
        <div class="glass-panel p-10 space-y-8">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 mb-2">Master Terms of Service</h1>
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Effective Date: December 28, 2025</p>
            </div>

            <article class="prose prose-slate max-w-none prose-headings:text-gray-900 prose-p:text-gray-600">
                <h3>1. Introduction and Acceptance</h3>
                <p>Welcome to the Akashic Library (the "Service"). By accessing or using our website, you engage in a binding contract with the Service Provider. You agree to be bound by these Terms, the <a href="privacy.php" class="text-blue-600 hover:underline">Privacy Policy</a>, and the <a href="dmca.php" class="text-blue-600 hover:underline">Copyright Policy</a>.</p>
                <p class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-400 text-yellow-800 text-sm font-semibold">
                    IF YOU DO NOT AGREE TO THESE TERMS, YOU ARE PROHIBITED FROM USING THIS SERVICE.
                </p>

                <h3>2. Definition of Service (The "Passive Conduit")</h3>
                <p>The Service is strictly defined as a <strong>Metadata Search Engine</strong>. It functions solely as an indexing tool that queries third-party public Application Programming Interfaces (APIs). The Service:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Does <strong>NOT</strong> host content on its servers.</li>
                    <li>Does <strong>NOT</strong> upload, curate, or select specific files for distribution.</li>
                    <li>Does <strong>NOT</strong> modify the underlying data fetched from external sources.</li>
                </ul>
                <p>Under the <strong>Electronic Commerce Act of 2000 (Republic Act No. 8792)</strong>, the Service acts as a mere conduit/intermediary and is not liable for the content transmitted through its system.</p>

                <h3>3. User Conduct and Prohibited Acts</h3>
                <p>You agree to use this Service strictly for <strong>Personal, Non-Commercial, Educational, and Research purposes</strong>. You are strictly prohibited from:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Using the Service to infringe upon the intellectual property rights of others.</li>
                    <li>Attempting to scrape, mass-download, or overload the Service's infrastructure.</li>
                    <li>Using the Service for any commercial gain (e.g., selling search results).</li>
                </ul>

                <h3>4. Governing Law and Exclusive Jurisdiction</h3>
                <p>These Terms shall be governed by and construed in accordance with the laws of the <strong>Republic of the Philippines</strong>.</p>
                <p class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400 text-blue-800 text-sm">
                    <strong>DISPUTE RESOLUTION:</strong> You agree that any legal action, suit, or proceeding arising out of or relating to these Terms or the Service shall be instituted <strong>EXCLUSIVELY</strong> in the competent courts of <strong>Quezon City, Philippines</strong>. You hereby waive any objection to venue or jurisdiction in such courts and agree not to plead or claim that any such action has been brought in an inconvenient forum.
                </p>

                <h3>5. Severability (The "Anti-Collapse" Clause)</h3>
                <p>If any provision of these Terms is deemed invalid, void, or unenforceable by a court of competent jurisdiction:
                1. That specific provision shall be limited or eliminated to the minimum extent necessary.
                2. The remaining provisions of these Terms shall remain in full force and effect.
                3. The invalid provision shall be replaced by a valid provision that comes closest to the intent of the original.</p>

                <h3>6. International Use (WIPO/Berne Compliance)</h3>
                <p>We comply with the <strong>Berne Convention for the Protection of Literary and Artistic Works</strong>. However, we make no representation that the Service is appropriate or available for use in all locations. Accessing the Service from territories where its content operates is illegal is prohibited. You are responsible for compliance with local laws.</p>
            </article>

            <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-400">Document Hash: <?php echo md5(date('Y-m-d')); ?> | Verifiable Public Record</p>
            </div>
        </div>
    </main>
</body>
</html>

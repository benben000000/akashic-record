<?php include '../api/proxy.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Akashic Library</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { ios: { blue: '#34C759', gray: '#8E8E93', bg: '#F2F2F7' } }, // Green theme for Privacy
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
            <div class="font-bold text-lg tracking-tight">Privacy Policy</div>
        </div>
    </nav>

    <main class="pt-28 pb-20 px-6 max-w-4xl mx-auto">
        <div class="glass-panel p-10 space-y-8">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Sovereignty & Privacy</h1>
                <p class="text-gray-500 text-sm">Compliant with RA 10173 (Data Privacy Act of 2012)</p>
            </div>

            <article class="prose prose-slate max-w-none prose-headings:text-gray-900 prose-p:text-gray-600">
                <h3>1. The "Stateless" Architecture</h3>
                <p>We believe in privacy by design. The Service operates on a strict <strong>Stateless Architecture</strong>. This means:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>We do not have a user database.</li>
                    <li>We do not require email registration or passwords.</li>
                    <li>We do not store logs of your search queries on our permanent storage.</li>
                </ul>

                <h3>2. Local Storage (Your Data, Your Device)</h3>
                <p>Features such as "Favorites" or "Bookmarks" utilize <strong>HTML5 LocalStorage</strong>. This data resides 100% on your personal device (browser cache). We cannot access, read, or sell this data because it never leaves your computer.</p>

                <h3>3. Third-Party API Interaction</h3>
                <p>When you perform a search, your query is transmitted through our proxy server to external providers (e.g., Google Books API, Internet Archive API). While we anonymize requests where possible, these third-party providers may collect metadata (like IP addresses) capable of identifying you. We advise reviewing their privacy policies:</p>
                <ul class="list-disc pl-5">
                    <li><a href="https://archive.org/about/privacy.php" target="_blank" class="text-blue-600 underline">Internet Archive Privacy Policy</a></li>
                    <li><a href="https://policies.google.com/privacy" target="_blank" class="text-blue-600 underline">Google Privacy Policy</a></li>
                </ul>

                <h3>4. Rights of the Data Subject (RA 10173)</h3>
                <p>Under the Philippine Data Privacy Act, you have the right to access, correct, and object to the processing of your data. However, since <strong>we do not hold any personal data about you</strong>, there is effectively nothing for us to delete or correct. This is the ultimate form of privacy protection.</p>
            </article>
        </div>
    </main>
</body>
</html>

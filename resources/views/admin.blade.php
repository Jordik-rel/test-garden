<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TailAdmin Layout</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <!-- MOBILE OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden lg:hidden z-20"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed z-30 top-0 left-0 w-64 h-full bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform">

        <div class="flex items-center gap-3 px-6 py-6 border-b">
            <span class="w-8 h-8 bg-slate-300 rounded-lg flex items-center justify-center text-white font-bold"><img src="{{ asset('logo.png') }}" alt="Gardena Connect"></span>
            <span class="text-xl font-semibold text-green-600">Gardena Connect</span>
        </div>

        <nav class="px-4 py-4 space-y-2 text-sm">

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100">
                <i class="bi bi-calendar3"></i> Calendar
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100">
                <i class="bi bi-person"></i> User Profile
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100">
                <i class="bi bi-ui-checks"></i> Forms
            </a>

            <p class="px-3 text-xs text-gray-400 mt-4">Tables</p>

            <a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="flex items-center gap-3"><i class="bi bi-table"></i> Tables</span>
                <i class="bi bi-chevron-down"></i>
            </a>

            <a href="#" class="ml-10 block px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                Basic Tables
            </a>

            <p class="px-3 text-xs text-gray-400 mt-4">Others</p>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100">
                <i class="bi bi-bar-chart"></i> Charts
            </a>

        </nav>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="lg:pl-64 min-h-screen">

        <!-- APPBAR -->
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-6">

            <!-- Left -->
            <div class="flex items-center gap-4">

                <!-- Mobile menu button -->
                <button id="openMenu" class="p-2 rounded-lg hover:bg-gray-100 lg:hidden">
                    <i class="bi bi-list text-2xl text-green-700"></i>
                </button>

                <!-- Search bar -->
                <div class="hidden md:flex items-center bg-gray-100 px-4 py-2 rounded-lg w-72">
                    <i class="bi bi-search text-gray-500"></i>
                    <input type="text" placeholder="Search..."
                        class="bg-transparent ml-2 w-full outline-none text-sm" />
                </div>
            </div>

            <!-- Right -->
            <div class="flex items-center gap-6">

                <button class="p-2 hover:bg-gray-100 rounded-lg text-xl">
                    <i class="bi bi-moon"></i>
                </button>

                <button class="relative p-2 hover:bg-gray-100 rounded-lg text-xl">
                    <i class="bi bi-bell"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-orange-500 rounded-full"></span>
                </button>

                <div class="flex items-center gap-2 cursor-pointer">
                    <img src="https://i.pravatar.cc/40?img=12" class="w-10 h-10 rounded-full" />
                    <span class="font-semibold">Musharof</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="p-6">

            <h1 class="text-2xl font-semibold mb-6">Basic Tables</h1>

            <!-- TABLES FROM PREVIOUS ANSWER -->
            <!-- (Tu peux coller ici la table déjà fournie) -->

            <div class="p-6 bg-white rounded-xl shadow-sm">
                <h2 class="text-lg font-semibold mb-4">Basic Table 1</h2>

                <!-- Table placeholder -->
                <p class="text-gray-500 text-sm">Collez ici le code de la table fournie précédemment.</p>
            </div>

        </main>
    </div>

    <!-- SCRIPT : Mobile sidebar -->
    <script>
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const openMenu = document.getElementById("openMenu");

        openMenu.onclick = () => {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        };

        overlay.onclick = () => {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        };
    </script>

</body>
</html>

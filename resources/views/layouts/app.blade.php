<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/09f28a4aba.js" crossorigin="anonymous"></script>
</head>

<body class="flex bg-gray-100 font-sans">

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="fixed lg:static top-0 left-0 h-1vh w-64 bg-gradient-to-b from-blue-500 to-indigo-600 text-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <div class="p-6 mb-8 text-3xl font-bold border-b border-white/20">
            MyKasir
        </div>
        <nav class="p-4 mt-10 space-y-3">
            <a href="{{ route('home') }}"
                class="flex items-center p-3 rounded-lg hover:bg-white/20 transition duration-200 text-white">
                <i class="fa-solid fa-house mr-3"></i> Home
            </a>
            <a href="{{ route('products.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-white/20 transition duration-200 text-white">
                <i class="fa-solid fa-box mr-3"></i> Products
            </a>
            <a href="{{ route('transactions.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-white/20 transition duration-200 text-white">
                <i class="fa-solid fa-cash-register mr-3"></i> Transactions
            </a>
            <a href="{{ route('reports.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-white/20 transition duration-200 text-white">
                <i class="fa-solid fa-file-lines mr-3"></i> Reports
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen">

        <header class="flex items-center justify-between bg-white shadow px-6 py-4 sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button id="menu-btn" class="lg:hidden text-gray-700 hover:text-blue-600 transition">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
                <span class="text-xl font-semibold text-gray-700">Dashboard</span>
            </div>
            <div>
                <span class="text-gray-600">
                    Hello,
                    <span class="font-medium">
                        {{ Auth::check() ? Auth::user()->usr_name : 'User' }}
                    </span>
                </span>
            </div>
        </header>

        <main class="p-6 bg-gray-100 flex-1">
            @yield('content')
        </main>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

</body>

</html>
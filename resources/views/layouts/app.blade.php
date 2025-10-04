<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex bg-gray-100">

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="fixed lg:static top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <div class="p-4 text-xl font-bold border-b">MyApp</div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-200">
                <i class="fa-solid fa-house mr-2"></i> Dashboard
            </a>
            <a href="{{ route('produk.index') }}" class="flex items-center p-2 rounded hover:bg-gray-200">
                <i class="fa-solid fa-box mr-2"></i> Produk
            </a>
            <a href="{{ route('transaksi.index') }}" class="flex items-center p-2 rounded hover:bg-gray-200">
                <i class="fa-solid fa-cash-register mr-2"></i> Transaksi
            </a>
            <a href="{{ route('laporan.index') }}" class="flex items-center p-2 rounded hover:bg-gray-200">
                <i class="fa-solid fa-file-lines mr-2"></i> Laporan
            </a>
        </nav>
    </aside>

    {{-- Content --}}
    <div class="flex-1 flex flex-col min-h-screen">

        {{-- Navbar --}}
        <header class="flex items-center justify-between bg-white shadow px-4 py-3">
            <div class="flex items-center gap-3">
                <button id="menu-btn" class="lg:hidden text-gray-700">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <span class="font-bold">Dashboard</span>
            </div>
            <div>
                <span class="text-gray-600">Halo, {{ Auth::user()->name ?? 'User' }}</span>
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    {{-- Script toggle sidebar --}}
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

    {{-- FontAwesome CDN --}}
    <script src="https://kit.fontawesome.com/your-key.js" crossorigin="anonymous"></script>
</body>

</html>
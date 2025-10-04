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
        class="fixed lg:static top-0 left-0 h-screen w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <div class="p-6 mb-10 text-2xl font-bold border-b bg-gradient-to-r from-blue-500 to-indigo-500 text-white">
            MyApp
        </div>
        <nav class="p-4 mt-10 space-y-2 border-t-4 border-black-10">
            <a href="{{ route('home') }}"
                class="flex items-center p-3 border-b-4 border-black-10 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-gray-700 hover:text-blue-600">
                <i class="fa-solid fa-house mr-3"></i> Home
            </a>

        </nav>
    </aside>

    {{-- Content --}}
    <div class="flex-1 flex flex-col min-h-screen">

        {{-- Navbar --}}
        <header class="flex items-center justify-between bg-white shadow px-6 py-4">
            <div class="flex items-center gap-3">
                <button id="menu-btn" class="lg:hidden text-gray-700 hover:text-blue-600 transition">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
                <span class="text-xl font-semibold text-gray-700">Dashboard</span>
            </div>
            <div>
                <span class="text-gray-600">Hello, <span class="font-medium">{{ Auth::user()->name ?? 'User' }}</span></span>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="p-6 bg-gray-100 flex-1">

            {{-- Example Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center hover:shadow-2xl transition-shadow duration-300">
                    <i class="fa-solid fa-box text-blue-500 text-4xl mr-4"></i>
                    <div>
                        <p class="text-gray-500">Total Products</p>
                        <p class="text-2xl font-bold text-gray-700">{{ $totalProducts ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center hover:shadow-2xl transition-shadow duration-300">
                    <i class="fa-solid fa-cash-register text-green-500 text-4xl mr-4"></i>
                    <div>
                        <p class="text-gray-500">Transactions</p>
                        <p class="text-2xl font-bold text-gray-700">{{ $totalTransactions ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center hover:shadow-2xl transition-shadow duration-300">
                    <i class="fa-solid fa-file-lines text-yellow-500 text-4xl mr-4"></i>
                    <div>
                        <p class="text-gray-500">Reports</p>
                        <p class="text-2xl font-bold text-gray-700">{{ $totalReports ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Recent Transactions Table --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Recent Transactions</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200 rounded">
                        <thead class="bg-blue-50 text-gray-600 uppercase text-sm">
                            <tr>
                                <th class="p-3 border-b">ID</th>
                                <th class="p-3 border-b">Customer</th>
                                <th class="p-3 border-b">Date</th>
                                <th class="p-3 border-b">Method</th>
                                <th class="p-3 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($recentTransactions ?? [] as $tx)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $tx->tsn_id }}</td>
                                <td class="p-3">{{ $tx->tsn_csm_name }}</td>
                                <td class="p-3">{{ $tx->tsn_date }}</td>
                                <td class="p-3">{{ $tx->tsn_metode }}</td>
                                <td class="p-3 font-semibold">${{ $tx->tsn_total }}</td>
                            </tr>
                            @endforeach
                            @if(empty($recentTransactions))
                            <tr>
                                <td colspan="5" class="text-center p-4 text-gray-400">No transactions yet</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

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

</body>

</html>
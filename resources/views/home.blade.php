@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- 1. Ringkasan Penjualan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <div class="flex items-center mb-2">
                <i class="fa-solid fa-money-bill-wave text-green-500 text-3xl mr-3"></i>
                <p class="text-gray-600 font-semibold">Total Penjualan Hari Ini</p>
            </div>
            <p class="text-2xl font-bold">Rp.{{ number_format($summary['total_sales_today'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <div class="flex items-center mb-2">
                <i class="fa-solid fa-receipt text-blue-500 text-3xl mr-3"></i>
                <p class="text-gray-600 font-semibold">Jumlah Transaksi Hari Ini</p>
            </div>
            <p class="text-2xl font-bold">{{ $summary['total_transactions_today'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <div class="flex items-center mb-2">
                <i class="fa-solid fa-chart-line text-purple-500 text-3xl mr-3"></i>
                <p class="text-gray-600 font-semibold">Rata-rata Transaksi</p>
            </div>
            <p class="text-2xl font-bold">Rp.{{ number_format($summary['avg_transaction'] ?? 0, 2) }}</p>
        </div>
    </div>

    {{-- 2. Informasi Kas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-600 font-semibold">Kas Awal</p>
            <p class="text-xl font-bold">Rp.{{ number_format($summary['cash_start'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-600 font-semibold">Kas Saat Ini</p>
            <p class="text-xl font-bold">Rp.{{ number_format($summary['cash_current'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-600 font-semibold">Kas Masuk</p>
            <p class="text-xl font-bold">Rp.{{ number_format($summary['cash_in'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-600 font-semibold">Kas Keluar</p>
            <p class="text-xl font-bold">Rp.{{ number_format($summary['cash_out'] ?? 0, 2) }}</p>
        </div>
    </div>
    <div class="bg-red-100 p-4 rounded-lg shadow">
        <p class="text-red-600 font-semibold">Selisih Kas: ${{ number_format($summary['cash_diff'] ?? 0, 2) }}</p>
    </div>

    {{-- 3. Transaksi Terbaru --}}
    <h2 class="text-xl font-bold mb-2">Transaksi Terbaru</h2>
    <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
        <table class="w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Nota</th>
                    <th class="border px-4 py-2 text-left">Waktu</th>
                    <th class="border px-4 py-2 text-left">Total</th>
                    <th class="border px-4 py-2 text-left">Metode</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $t)
                <tr>
                    <td class="border px-4 py-2">{{ $t->tsn_id }}</td>
                    <td class="border px-4 py-2">{{ $t->tsn_date->format('H:i d-m-Y') }}</td>
                    <td class="border px-4 py-2">Rp.{{ number_format($t->tsn_total,2) }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($t->tsn_metode) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('transactions.show', $t) }}" class="text-blue-500 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Tidak ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 4. Produk / Stok Cepat --}}
    <h2 class="text-xl font-bold mt-6 mb-2">Produk Terlaris & Stok Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold mb-2">Produk Terlaris Hari Ini</h3>
            <ul class="list-disc ml-5">
                @foreach($top_products as $p)
                <li>
                    <a href="{{ route('products.show', $p['product_id']) }}" class="text-blue-500 hover:underline">
                        {{ $p['product_name'] }} - {{ $p['quantity_sold'] }} terjual
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold mb-2">Stok Hampir Habis</h3>
            <ul class="list-disc ml-5">
                @foreach($low_stock_products as $p)
                <li>
                    <a href="{{ route('products.show', $p->prd_id) }}" class="text-red-500 hover:underline">
                        {{ $p->prd_name }} ({{ $p->prd_stock }})
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold mb-2">Promo / Diskon Aktif</h3>
            <ul class="list-disc ml-5">
                @foreach($active_promos as $promo)
                <li>{{ $promo->name }} - {{ $promo->discount }}%</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- 5. Notifikasi Penting --}}
    <div class="bg-yellow-100 p-4 rounded-lg shadow mt-6">
        <h3 class="font-semibold mb-2">Notifikasi Penting</h3>
        <ul class="list-disc ml-5">
            @foreach($notifications as $note)
            <li>{{ $note }}</li>
            @endforeach
        </ul>
    </div>

    {{-- 6. Shortcut --}}
    <div class="flex flex-wrap gap-4 mt-6">
        <a href="{{ route('transactions.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">Transaksi Baru</a>
        <a href="{{ route('reports.index') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">Laporan Harian</a>
    </div>

    {{-- 7. Grafik Singkat (opsional) --}}
    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <h2 class="font-bold mb-4">Grafik Penjualan Mingguan</h2>
        <canvas id="salesChart"></canvas>
    </div>
</div>

{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {
                !!json_encode($weekly_labels) !!
            },
            datasets: [{
                label: 'Penjualan',
                data: {
                    !!json_encode($weekly_sales) !!
                },
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
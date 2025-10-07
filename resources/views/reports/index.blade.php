@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Sales Report</h1>

    <div class="mb-4">
        <span class="font-semibold">Period:</span> {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}
    </div>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded shadow">
            <h2 class="font-bold">Total Transactions</h2>
            <p class="text-lg">{{ $summary['total_transactions'] }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded shadow">
            <h2 class="font-bold">Total Sales</h2>
            <p class="text-lg">Rp.{{ number_format($summary['total_sales'], 2) }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded shadow">
            <h2 class="font-bold">Items Sold</h2>
            <p class="text-lg">{{ $summary['total_items_sold'] }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded shadow">
            <h2 class="font-bold">Payment Methods</h2>
            @foreach($summary['payment_methods'] as $method => $amount)
            <div>{{ ucfirst($method) }}: Rp.{{ number_format($amount, 2) }}</div>
            @endforeach
        </div>
    </div>

    {{-- Top Products --}}
    <div class="mb-6">
        <h2 class="font-bold mb-2">Top Products</h2>
        <ul class="list-disc ml-6">
            @foreach($top_products as $product)
            <li>
                <a href="{{ route('products.show', $product['product_id']) }}" class="text-blue-500 hover:underline">
                    {{ $product['product_name'] }} - {{ $product['quantity_sold'] }} sold
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- Daftar transaksi --}}
    <h2 class="font-bold mb-2">Transactions</h2>
    <table class="w-full table-auto border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Invoice</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Cashier</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
            <tr>
                <td class="border px-4 py-2">{{ $t->tsn_id }}</td>
                <td class="border px-4 py-2">{{ $t->tsn_date->format('Y-m-d') }}</td>
                <td class="border px-4 py-2">{{ $t->user->name ?? $t->tsn_usr_id }}</td>
                <td class="border px-4 py-2">Rp.{{ number_format($t->tsn_total, 2) }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('reports.show', $t) }}" class="text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border px-4 py-2 text-center">No transactions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
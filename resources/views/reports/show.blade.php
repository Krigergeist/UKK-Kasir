@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Transaction #{{ $transaction->tsn_id }}</h1>

    <div class="mb-4">
        <strong>Date:</strong> {{ $transaction->tsn_date->format('Y-m-d') }}<br>
        <strong>Cashier:</strong> {{ $transaction->user->name ?? $transaction->tsn_usr_id }}<br>
        <strong>Payment:</strong> {{ ucfirst($transaction->tsn_metode) }}<br>
        <strong>Total:</strong> Rp.{{ number_format($transaction->tsn_total,2) }}
    </div>

    <h2 class="font-bold mb-2">Items</h2>
    <table class="w-full table-auto border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Product</th>
                <th class="border px-4 py-2 text-left">Qty</th>
                <th class="border px-4 py-2 text-left">Price</th>
                <th class="border px-4 py-2 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
            <tr>
                <td class="border px-4 py-2">
                    @if($detail->product)
                    <a href="{{ route('products.show', $detail->product->prd_id) }}" class="text-blue-500 hover:underline">
                        {{ $detail->product->prd_name }}
                    </a>
                    @else
                    <span class="text-red-500">[Produk sudah dihapus]</span>
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $detail->tsnd_qty }}</td>
                <td class="border px-4 py-2">
                    {{ $detail->product ? 'Rp.'.number_format($detail->product->prd_price,2) : '-' }}
                </td>
                <td class="border px-4 py-2">
                    {{ $detail->product ? 'Rp.'.number_format($detail->tsnd_qty * $detail->product->prd_price,2) : '-' }}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
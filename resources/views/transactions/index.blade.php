@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add Transaction</a>
    </div>

    {{-- 🔎 Search --}}
    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari customer..." class="border p-2 rounded w-1/3">
        <button class="px-4 bg-green-500 text-white rounded">Cari</button>
    </form>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    @php
    function sortTx($column, $title) {
    $currentSort = request('sort');
    $currentDir = request('dir', 'asc');
    $newDir = ($currentSort == $column && $currentDir == 'asc') ? 'desc' : 'asc';
    $icon = $currentSort == $column
    ? ($currentDir == 'asc' ? '↑' : '↓')
    : '↕';
    return '<a href="?sort='.$column.'&dir='.$newDir.'&search='.request('search').'"
        class="flex items-center justify-between w-full">'
        .'<span class="text-left">'.$title.'</span>'
        .'<span class="ml-1 text-gray-600">'.$icon.'</span>'
        .'</a>';
    }
    @endphp

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border text-left">{!! sortTx('tsn_id','ID') !!}</th>
                <th class="p-2 border text-left">{!! sortTx('tsn_csm_name','Customer') !!}</th>
                <th class="p-2 border text-left">{!! sortTx('tsn_date','Date') !!}</th>
                <th class="p-2 border text-left">{!! sortTx('tsn_metode','Method') !!}</th>
                <th class="p-2 border text-left">Products</th>
                <th class="p-2 border text-left">{!! sortTx('total_qty','Qty') !!}</th>
                <th class="p-2 border text-left">{!! sortTx('tsn_total','Total') !!}</th>
                <th class="p-2 border text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tx)
            <tr>
                <td class="p-2 border">{{ $tx->tsn_id }}</td>
                <td class="p-2 border">{{ $tx->tsn_csm_name }}</td>
                <td class="p-2 border">{{ $tx->tsn_date }}</td>
                <td class="p-2 border">{{ ucfirst($tx->tsn_metode) }}</td>
                <td class="p-2 border">
                    <ul class="list-disc ml-4">
                        @foreach($tx->details as $detail)
                        <li>{{ $detail->product->prd_name ?? 'Produk dihapus' }} ({{ $detail->tsnd_qty }})</li>
                        @endforeach
                    </ul>
                </td>
                <td class="p-2 border">{{ $tx->total_qty }}</td>
                <td class="p-2 border">Rp {{ number_format($tx->tsn_total,0,',','.') }}</td>
                <td class="p-2 border grid grid-cols-2 overflow-y-auto gap-2">
                    <a href="{{ route('transactions.edit', $tx) }}" class="px-2 py-1 w-full bg-yellow-500 text-white text-center font-bold rounded">Edit</a>
                    <form action="{{ route('transactions.destroy', $tx) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 w-full bg-red-500 text-white text-center font-bold rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center p-4 text-gray-400">No transactions yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>


    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add Transaction</a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border text-left">ID</th>
                <th class="p-2 border text-left">Customer</th>
                <th class="p-2 border text-left">Date</th>
                <th class="p-2 border text-left">Method</th>
                <th class="p-2 border text-left">Total</th>
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
                <td colspan="6" class="text-center p-4 text-gray-400">No transactions yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
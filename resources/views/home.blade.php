@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-box text-blue-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Total Products</p>
            <p class="text-xl font-bold"></p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-cash-register text-green-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Total Transactions</p>
            <p class="text-xl font-bold"></p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-file-lines text-yellow-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Total Reports</p>
            <p class="text-xl font-bold"></p>
        </div>
    </div>
</div>

<h2 class="text-xl font-bold mb-2">Recent Transactions</h2>
<div class="bg-white p-4 rounded-lg shadow">
    <table class="w-full table-auto">
        <thead class="border-b">
            <tr class="text-left">
                <th class="p-2">ID</th>
                <th class="p-2">Customer</th>
                <th class="p-2">Date</th>
                <th class="p-2">Method</th>
                <th class="p-2">Total</th>
            </tr>
        </thead>

    </table>
</div>
@endsection
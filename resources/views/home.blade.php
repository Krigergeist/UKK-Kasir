@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-box text-blue-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Total Produk</p>
            <p class="text-xl font-bold">120</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-cash-register text-green-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Transaksi Hari Ini</p>
            <p class="text-xl font-bold">35</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-file-lines text-yellow-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Laporan Bulan Ini</p>
            <p class="text-xl font-bold">12</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow flex items-center">
        <i class="fa-solid fa-users text-purple-500 text-3xl mr-4"></i>
        <div>
            <p class="text-gray-600">Pengguna</p>
            <p class="text-xl font-bold">5</p>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block font-semibold">Kode Produk</label>
            <input type="text" name="prd_code" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="prd_name" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Harga</label>
            <input type="number" name="prd_price" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Stok</label>
            <input type="number" name="prd_stock" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Description</label>
            <input type="text" name="prd_description" class="w-full border rounded p-2">
        </div>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
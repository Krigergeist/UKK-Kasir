@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>
    <form action="{{ route('products.update', $product->prd_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block font-semibold">Kode Produk</label>
            <input type="text" name="prd_code"
                value="{{ old('prd_code', $product->prd_code) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="prd_name"
                value="{{ old('prd_name', $product->prd_name) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Harga</label>
            <input type="number" name="prd_price"
                value="{{ old('prd_price', $product->prd_price) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Stok</label>
            <input type="number" name="prd_stock"
                value="{{ old('prd_stock', $product->prd_stock) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Deskripsi</label>
            <input type="text" name="prd_description"
                value="{{ old('prd_description', $product->prd_description) }}"
                class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
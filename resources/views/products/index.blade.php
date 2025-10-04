@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Daftar Produk</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Kode</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Harga</th>
                <th class="p-2 border">Stok</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td class="p-2 border">{{ $product->prd_code }}</td>
                <td class="p-2 border">{{ $product->prd_name }}</td>
                <td class="p-2 border">Rp {{ number_format($product->prd_price,0,',','.') }}</td>
                <td class="p-2 border">{{ $product->prd_stock }}</td>
                <td class="p-2 border">{{ $product->prd_description }}</td>
                <td class="p-2 border grid grid-cols-2 overflow-y-auto gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="px-2 py-1 w-full bg-yellow-500 text-white text-center font-bold rounded">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 w-full bg-red-500 text-white text-center font-bold rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
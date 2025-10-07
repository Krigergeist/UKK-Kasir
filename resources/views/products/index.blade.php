@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Daftar Produk</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>
    </div>

    {{-- Form pencarian --}}
    <form method="GET" action="{{ route('products.index') }}" class="flex gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari produk..." class="border p-2 rounded w-1/3">
        <button class="px-4 bg-green-500 text-white rounded">Cari</button>
    </form>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                @php
                // Helper buat ganti urutan sort
                function sortLink($column, $title) {
                $currentSort = request('sort');
                $currentDir = request('dir', 'asc');
                $newDir = ($currentSort == $column && $currentDir == 'asc') ? 'desc' : 'asc';
                $icon = $currentSort == $column
                ? ($currentDir == 'asc' ? '↑' : '↓')
                : '↕';
                return '<a href="?sort='.$column.'&dir='.$newDir.'" class="flex items-center justify-between w-full">'
                    .'<span class="text-left">'.$title.'</span>'
                    .'<span class="ml-1 text-gray-600">'.$icon.'</span>'
                    .'</a>';
                }
                @endphp

                <th class="p-2 border text-left">{!! sortLink('prd_code','Kode') !!}</th>
                <th class="p-2 border text-left">{!! sortLink('prd_name','Nama') !!}</th>
                <th class="p-2 border text-left">{!! sortLink('prd_price','Harga') !!}</th>
                <th class="p-2 border text-left">{!! sortLink('prd_stock','Stok') !!}</th>
                <th class="p-2 border text-left">{!! sortLink('prd_description','Deskripsi') !!}</th>
                <th class="p-2 border text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr @if($product->prd_stock <= 5) class="bg-red-100" @endif>
                    <td class="p-2 border">{{ $product->prd_code }}</td>
                    <td class="p-2 border">{{ $product->prd_name }}</td>
                    <td class="p-2 border">Rp {{ number_format($product->prd_price,0,',','.') }}</td>
                    <td class="p-2 border">
                        {{ $product->prd_stock }}
                        @if($product->prd_stock <= 5)
                            <span class="ml-2 text-red-600 font-bold">(Hampir habis!)</span>
                            @endif
                    </td>
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
                <td colspan="6" class="text-center p-4">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
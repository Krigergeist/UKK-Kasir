@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Add Transaction</h1>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block font-semibold">Customer Name</label>
            <input type="text" name="tsn_csm_name" value="{{ old('tsn_csm_name') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Date</label>
            <input type="date" name="tsn_date" value="{{ old('tsn_date', date('Y-m-d')) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Payment Method</label>
            <select name="tsn_metode" class="w-full border rounded p-2" required>
                <option value="cash">Cash</option>
                <option value="credit">Credit</option>
                <option value="debit">Debit</option>
            </select>
        </div>

        <h2 class="text-lg font-semibold mb-2">Products</h2>
        <div id="products-list" class="space-y-2 mb-4">
            <div class="flex gap-2">
                <select name="products[0][id]" class="border rounded p-2 flex-1" required>
                    @foreach($products as $product)
                    <option value="{{ $product->prd_id }}">{{ $product->prd_name }} - Rp {{ number_format($product->prd_price,0,',','.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[0][quantity]" class="w-20 border rounded p-2" value="1" min="1" required>
                <button type="button" onclick="removeProduct(this)" class="px-2 bg-red-500 text-white rounded">X</button>
            </div>
        </div>

        <button type="button" onclick="addProduct()" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Add Product</button>
        <br>
        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<script>
    let productIndex = 1;

    function addProduct() {
        const productsList = document.getElementById('products-list');
        const newRow = document.createElement('div');
        newRow.classList.add('flex', 'gap-2', 'mb-2');
        newRow.innerHTML = `
        <select name="products[${productIndex}][id]" class="border rounded p-2 flex-1" required>
            @foreach($products as $product)
            <option value="{{ $product->prd_id }}">{{ $product->prd_name }} - Rp {{ number_format($product->prd_price,0,',','.') }}</option>
            @endforeach
        </select>
        <input type="number" name="products[${productIndex}][quantity]" class="w-20 border rounded p-2" value="1" min="1" required>
        <button type="button" onclick="removeProduct(this)" class="px-2 bg-red-500 text-white rounded">X</button>
    `;
        productsList.appendChild(newRow);
        productIndex++;
    }

    function removeProduct(button) {
        button.parentElement.remove();
    }
</script>
@endsection
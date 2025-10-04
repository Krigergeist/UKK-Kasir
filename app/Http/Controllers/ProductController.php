<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prd_code' => 'required|unique:products,prd_code',
            'prd_name' => 'required|string|max:255',
            'prd_price' => 'required|integer',
            'prd_stock' => 'required|integer',
        ]);

        Product::create([
            'prd_usr_id'   => Auth::id(), // simpan user yang menambahkan
            'prd_code'     => $request->prd_code,
            'prd_name'     => $request->prd_name,
            'prd_price'    => $request->prd_price,
            'prd_stock'    => $request->prd_stock,
            'prd_description' => $request->prd_description,
            'prd_img'      => $request->prd_img,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'prd_code' => 'required|unique:products,prd_code,' . $product->prd_id . ',prd_id',
            'prd_name' => 'required|string|max:255',
            'prd_price' => 'required|integer',
            'prd_stock' => 'required|integer',
        ]);

        $product->update([
            'prd_usr_id'   => Auth::id(), // simpan user yang edit
            'prd_code'     => $request->prd_code,
            'prd_name'     => $request->prd_name,
            'prd_price'    => $request->prd_price,
            'prd_stock'    => $request->prd_stock,
            'prd_description' => $request->prd_description,
            'prd_img'      => $request->prd_img,
            'updated_by' => Auth::id(), // opsional
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}

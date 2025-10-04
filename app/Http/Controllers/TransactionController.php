<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.product')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tsn_csm_name' => 'required|string|max:100',
            'tsn_date' => 'required|date',
            'tsn_metode' => 'required|in:cash,credit,debit',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,prd_id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $total += $product->prd_price * $item['quantity'];
        }

        $transaction = Transaction::create([
            'tsn_usr_id' => Auth::id(),
            'tsn_csm_name' => $request->tsn_csm_name,
            'tsn_date' => $request->tsn_date,
            'tsn_metode' => $request->tsn_metode,
            'tsn_total' => $total,
            'created_by' => Auth::id(),
        ]);

        foreach ($request->products as $item) {
            Transaction_Detail::create([
                'tsnd_usr_id' => Auth::id(),         // sesuai migration
                'tsnd_tsn_id' => $transaction->tsn_id,
                'tsnd_prd_id' => $item['id'],        // sesuai migration
                'tsnd_qty' => $item['quantity'],     // sesuai migration
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product');
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $transaction->load('details');
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'tsn_csm_name' => 'required|string|max:100',
            'tsn_date' => 'required|date',
            'tsn_metode' => 'required|in:cash,credit,debit',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,prd_id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $total += $product->prd_price * $item['quantity'];
        }

        $transaction->update([
            'tsn_usr_id' => Auth::id(),
            'tsn_csm_name' => $request->tsn_csm_name,
            'tsn_date' => $request->tsn_date,
            'tsn_metode' => $request->tsn_metode,
            'tsn_total' => $total,
            'updated_by' => Auth::id(),
        ]);

        // Hapus detail lama
        $transaction->details()->delete();

        // Tambah detail baru
        foreach ($request->products as $item) {
            Transaction_Detail::create([
                'tsn_usr_id' => Auth::id(),
                'tsnd_tsn_id' => $transaction->tsn_id,
                'tsnd_prod_id' => $item['id'],
                'tsnd_quantity' => $item['quantity'],
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}

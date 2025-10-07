<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('details.product');

        // 🔎 Pencarian by customer
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('details.product', function ($q) use ($search) {
                $q->where('prd_name', 'like', "%$search%");
            })->orWhere('tsn_csm_name', 'like', "%$search%");
        }

        // ⬆⬇ Sorting
        $allowedSorts = ['tsn_id', 'tsn_csm_name', 'tsn_date', 'tsn_metode', 'tsn_total', 'total_qty'];
        $sort = $request->get('sort', 'tsn_id');
        $dir = $request->get('dir', 'asc');

        // Tambahkan field total_qty untuk sorting
        $query->withCount(['details as total_qty' => function ($q) {
            $q->select(DB::raw("SUM(tsnd_qty)"));
        }]);

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'tsn_id';
        }

        if ($sort == 'total_qty') {
            $query->orderBy('total_qty', $dir);
        } else {
            $query->orderBy($sort, $dir);
        }

        $transactions = $query->paginate(10)->appends($request->query());

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

        // kurangi stok
        $product->prd_stock -= $item['quantity'];
        $product->save();

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

        // 1. Kembalikan stok dari detail lama
        foreach ($transaction->details as $detail) {
            $product = Product::find($detail->tsnd_prd_id);
            if ($product) {
                $product->prd_stock += $detail->tsnd_qty; // balikin stok lama
                $product->save();
            }
        }

        // 2. Hapus detail lama
        $transaction->details()->delete();

        // 3. Tambahkan detail baru + kurangi stok
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);

            Transaction_Detail::create([
                'tsnd_usr_id' => Auth::id(),
                'tsnd_tsn_id' => $transaction->tsn_id,
                'tsnd_prd_id' => $item['id'],
                'tsnd_qty' => $item['quantity'],
                'created_by' => Auth::id(),
            ]);

            $product->prd_stock -= $item['quantity'];
            $product->save();
        }

        if ($product->prd_stock < $item['quantity']) {
            return back()->withErrors(['msg' => "Stok {$product->prd_name} tidak cukup!"]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}

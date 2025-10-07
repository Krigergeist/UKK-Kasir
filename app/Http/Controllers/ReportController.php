<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode (opsional: tanggal awal dan akhir)
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        // 1. Informasi Dasar
        $transactions = Transaction::with('details.product')
            ->whereBetween('tsn_date', [$startDate, $endDate])
            ->latest()
            ->get();

        // 2. Ringkasan Transaksi
        $summary = [
            'total_transactions' => $transactions->count(),
            'total_sales' => $transactions->sum('tsn_total'),
            'total_items_sold' => $transactions->sum(function ($t) {
                return $t->details->sum('tsnd_qty');
            }),
            'payment_methods' => $transactions->groupBy('tsn_metode')->map->sum('tsn_total')
        ];

        // 5. Laporan Produk
        $products_sold = Transaction_Detail::with('product')
            ->whereHas('transaction', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('tsn_date', [$startDate, $endDate]);
            })
            ->get();

        $top_products = Transaction_Detail::with('product')
            ->whereHas('transaction', function ($q) {
                $q->whereDate('tsn_date', now());
            })
            ->get()
            ->groupBy('tsnd_prod_id')
            ->map(function ($group) {
                $product = $group->first()->product;
                if (!$product) return null; // skip jika produk sudah dihapus
                return [
                    'product_name' => $product->prd_name,
                    'quantity_sold' => $group->sum('tsnd_qty'),
                    'product_id' => $product->prd_id
                ];
            })
            ->filter() // buang null
            ->sortByDesc('quantity_sold')
            ->take(5);


        return view('reports.index', compact('transactions', 'summary', 'top_products', 'startDate', 'endDate'));
    }

    public function show(Transaction $transaction)
    {
        // Detail transaksi lengkap
        $transaction->load(['details.product' => function ($q) {
            $q->whereNotNull('prd_id');
        }]);;
        return view('reports.show', compact('transaction'));
    }
}

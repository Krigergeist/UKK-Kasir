<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Transaction_Detail;

class HomeController extends Controller
{
    public function index()
    {
        // Transaksi terbaru 5
        $recentTransactions = Transaction::with('details.product', 'user')
            ->latest()
            ->take(5)
            ->get();

        // Ringkasan Penjualan hari ini
        $todayTransactions = Transaction::whereDate('tsn_date', now())->get();
        $totalSalesToday = $todayTransactions->sum('tsn_total');
        $totalTransactionsToday = $todayTransactions->count();
        $avgTransaction = $totalTransactionsToday ? $totalSalesToday / $totalTransactionsToday : 0;

        // Top produk hari ini
        $top_products = Transaction_Detail::with('product')
            ->whereHas('transaction', function ($q) {
                $q->whereDate('tsn_date', now());
            })
            ->get()
            ->groupBy('tsnd_prod_id')
            ->map(function ($group) {
                $product = $group->first()->product;

                // Jika produk sudah dihapus atau null, skip
                if (!$product) return null;

                return [
                    'product_name' => $product->prd_name,
                    'quantity_sold' => $group->sum('tsnd_qty'),
                    'product_id' => $product->prd_id
                ];
            })
            ->filter() // buang null
            ->sortByDesc('quantity_sold')
            ->take(5);

        // Kas dummy / sementara
        $summary = [
            'total_sales_today' => $totalSalesToday,
            'total_transactions_today' => $totalTransactionsToday,
            'avg_transaction' => $avgTransaction,
            'cash_start' => 0, // bisa diganti dari tabel kas
            'cash_current' => 0,
            'cash_in' => 0,
            'cash_out' => 0,
            'cash_diff' => 0
        ];

        // Produk stok rendah
        $low_stock_products = Product::where('prd_stock', '<=', 5)->get();

        // Promo aktif (jika ada tabel promos)
        $active_promos = []; // bisa diganti query dari tabel promo

        // Notifikasi dummy
        $notifications = [];

        // Grafik mingguan dummy
        $weekly_labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $weekly_sales = [150, 200, 180, 220, 170, 210, 190];

        return view('home', compact(
            'recentTransactions',
            'summary',
            'top_products',
            'low_stock_products',
            'active_promos',
            'notifications',
            'weekly_labels',
            'weekly_sales'
        ));
    }
}

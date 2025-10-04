<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\Report;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }


    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function transactions()
    {
        $transactions = Transaction::with('details')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function reports()
    {
        $reports = Report::latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }
}

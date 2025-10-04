<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('landing');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/transactions', [HomeController::class, 'transactions'])->name('transactions');
    Route::get('/reports', [HomeController::class, 'reports'])->name('reports');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('transactions', \App\Http\Controllers\TransactionController::class);
    Route::resource('reports', ReportController::class);
});

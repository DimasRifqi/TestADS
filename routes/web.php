<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\KeranjangController;


Route::get('/', [HalamanUtamaController::class, 'index']);
Route::get('/menu', [HalamanUtamaController::class, 'index_menu']);
Route::get('/about', [HalamanUtamaController::class, 'index_about']);
Route::get('/bookTable', [HalamanUtamaController::class, 'index_bookTable']);

Route::group(['middleware' => ['auth']], function() {

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');;
    Route::post('/keranjang/tambah', [KeranjangController::class, 'create'])->name('keranjang.create');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('/keranjang/update-qty', [KeranjangController::class, 'updateQty'])->name('keranjang.updateQty');
    // Route::post('/midtrans/callback', [KeranjangController::class, 'handleMidtransCallback'])->name('midtrans.callback');

    Route::post('/midtrans/callback', [KeranjangController::class, 'handleCallback'])->name('midtrans.callback');



});

Route::group(['middleware' => ['auth', 'role:2']], function() {

    Route::resource('produk', ProdukController::class);

});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
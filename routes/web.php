<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HalamanUtamaController;

// Route::get('/', function () {
//     return view('index');
// });


Route::get('/', [HalamanUtamaController::class, 'index']);
Route::get('/menu', [HalamanUtamaController::class, 'index_menu']);

// Route::get('/produk', [ProdukController::class, 'index']);
// Route::post('/addproduk', [ProdukController::class, 'store']);

// Route::resource('produk', ProdukController::class);

Route::group(['middleware' => ['auth', 'role:2']], function() {

    Route::resource('produk', ProdukController::class);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
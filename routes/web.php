<?php

use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });


Route::get('/', [HalamanUtamaController::class, 'index']);
Route::get('/menu', [HalamanUtamaController::class, 'index_menu']);

// Route::get('/produk', [ProdukController::class, 'index']);
// Route::post('/addproduk', [ProdukController::class, 'store']);

Route::resource('produk', ProdukController::class);
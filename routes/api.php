<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(["auth:sanctum"])->group(function(){

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index']);
        Route::get('/{id}', [ProdukController::class, 'show']);
        Route::post('/', [ProdukController::class, 'store']);
        Route::put('/{id}', [ProdukController::class, 'update']);
        Route::delete('/{id}', [ProdukController::class, 'destroy']);
    });

});
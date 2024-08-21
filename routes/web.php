<?php

use App\Http\Controllers\HalamanUtama;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });


Route::get('/', [HalamanUtama::class, 'index']);
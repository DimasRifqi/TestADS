<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HalamanUtama extends Controller
{
    public function index()
    {
        $data = Produk::all();
        return view('index', compact('data'));
    }
}
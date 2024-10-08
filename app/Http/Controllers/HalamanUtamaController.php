<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HalamanUtamaController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        return view('index', compact('data'));
    }

    public function index_menu()
    {
        $data = Produk::all();
        return view('menu', compact('data'));
    }

    public function index_about()
    {
        return view('about');
    }

    public function index_bookTable()
    {
        return view('book_table');
    }

}
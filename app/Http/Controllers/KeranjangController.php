<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $keranjang = Keranjang::where('user_id', $userId)->get();

        $totalHarga = $keranjang->sum(function($item) {
            return $item->qty * $item->produk->harga;
        });

        return view('Keranjang.index', compact('keranjang', 'totalHarga'));
    }

    public function create(Request $request)
    {
        $produkId = $request->input('produk_id');
        $produk = Produk::findOrFail($produkId);

        $userId = Auth::id();

        $keranjangItem = Keranjang::where('user_id', $userId)
                                  ->where('produk_id', $produkId)
                                  ->first();

        if ($keranjangItem) {

            $keranjangItem->qty += 1;
            $keranjangItem->save();
        } else {
            Keranjang::create([
                'user_id' => $userId,
                'produk_id' => $produkId,
                'qty' => 1,
                'harga' => $produk->harga,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateQty(Request $request)
    {
        $itemId = $request->input('id');
        $action = $request->input('action');

        // Temukan item keranjang berdasarkan ID
        $item = Keranjang::find($itemId);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }

        // Update kuantitas
        if ($action === 'increase') {
            $item->qty++;
        } elseif ($action === 'decrease') {
            $item->qty--;
        }

        // Hapus item jika kuantitas menjadi 0
        if ($item->qty <= 0) {
            $item->delete();
            return response()->json(['success' => true, 'itemDeleted' => true]);
        } else {
            $item->save();
        }

        // Hitung total harga
        $totalPrice = $item->qty * $item->produk->harga;
        $totalHarga = Keranjang::sum(DB::raw('qty * harga'));

        return response()->json([
            'success' => true,
            'qty' => $item->qty,
            'totalPrice' => number_format($totalPrice),
            'grandTotal' => number_format($totalHarga),
            'itemDeleted' => false
        ]);
    }


}
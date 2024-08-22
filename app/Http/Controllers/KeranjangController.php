<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        $orderId = 'ORDER-' . rand(1000, 9999) . '-' . time();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Assuming there is at least one item in the cart
        if ($keranjang->isNotEmpty()) {
            $user = $keranjang->first()->user;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $totalHarga,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('Keranjang.index', compact('keranjang', 'totalHarga', 'snapToken'));
        } else {
            // Handle case where the cart is empty
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }
    }

    // public function handleMidtransCallback(Request $request)
    // {
    //     // Cek apakah status transaksi adalah 'success'
    //     if ($request->input('transaction_status') == 'success') {
    //         $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

    //         // Hapus semua item keranjang untuk pengguna tersebut
    //         $deleted = Keranjang::where('user_id', $userId)->delete();

    //         if ($deleted) {
    //             return response()->json(['success' => true]);
    //         } else {
    //             return response()->json(['success' => false, 'message' => 'Tidak ada item yang dihapus']);
    //         }
    //     }

    //     return response()->json(['success' => false, 'message' => 'Transaksi tidak berhasil']);
    // }

    public function handleCallback(Request $request)
    {
        Log::info('Midtrans callback received', $request->all());

        $transactionStatus = $request->input('transaction_status');
        $orderId = $request->input('order_id');

        Log::info('Transaction Status: ' . $transactionStatus);
        Log::info('Order ID: ' . $orderId);

        if ($transactionStatus === 'success') {

            $userId = Auth::id();

            if ($userId) {

                $deleted = Keranjang::where('user_id', $userId)->delete();

                Log::info('Items deleted count: ' . $deleted);

                if ($deleted) {
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Tidak ada item yang dihapus']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Pengguna tidak terautentikasi']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Transaksi tidak berhasil']);
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
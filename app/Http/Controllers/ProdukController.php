<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        $categories = ProdukKategori::all();
        return view('Produk.index', compact('data','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'produk_kategori_id' => 'required|exists:produk_kategori,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = 'foto-'.uniqid().'.'.$file->extension();
            $file->move(public_path('asset_produk/foto_produk/'), $fileName);
        } else {
            $fileName = '';
        }

        $produk = Produk::create([
            'nama' => $request->input('nama'),
            'produk_kategori_id' => $request->input('produk_kategori_id'),
            'foto' => $fileName,
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'produk_kategori_id' => 'required|exists:produk_kategori,id',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        try {
            $produk = Produk::findOrFail($id);
            $produk->fill($request->all());

            if ($request->hasFile('foto')) {
                $fileName = time().'.'.$request->foto->extension();
                $request->foto->move(public_path('asset_produk/foto_produk'), $fileName);
                $produk->foto = $fileName;
            }

            $produk->save();
            return response()->json(['message' => 'Produk berhasil diperbarui', 'produk' => $produk], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }


}
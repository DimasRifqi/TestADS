<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();

        return new DataResource(true, 'List Data Produk', $data);
    }

    public function show($id)
    {
        $data = Produk::find($id);

        if ($data) {
            return new DataResource(true, 'Detail Data Produk', $data);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk Tidak Ditemukan',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'nama' => 'required|string|max:255',
            'produk_kategori_id' => 'required|exists:produk_kategori,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('foto')) {
            $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/FotoProduk'), $fileName);
        } else {
            $fileName = '';
        }

        $data = Produk::create([
            'nama' => $request->nama,
            'produk_kategori_id' => $request->produk_kategori_id,
            'foto' => $fileName,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return new DataResource(true, 'Data Produk Berhasil Ditambah', $data);
    }

    public function update(Request $request, $id)
    {
        $fotoLama = Produk::where('id', $id)->value('foto');

        $validator = validator()->make($request->all(), [
            'nama' => 'required|string',
            'produk_kategori_id' => 'required|exists:produk_kategori,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('foto')) {
            if (!empty($fotoLama)) {
                unlink(public_path('asset_produk/foto_produk/' . $fotoLama));
            }

            $fileName = 'foto-' . $id . '.' . $request->foto->extension();
            $request->foto->move(public_path('asset_produk/foto_produk'), $fileName);
        } else {
            $fileName = $fotoLama;
        }

        $data = Produk::whereId($id)->update([
            'nama' => $request->nama,
            'produk_kategori_id' => $request->produk_kategori_id,
            'foto' => $fileName,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return new DataResource(true, 'Data Produk Berhasil Diubah', $data);
    }

    public function destroy($id)
    {
        $data = Produk::find($id);

        if ($data) {
            if (!empty($data->foto)) {
                unlink(public_path('asset_produk/foto_produk/' . $data->foto));
            }

            $data->delete();
            return new DataResource(true, 'Data Produk Berhasil Dihapus', $data);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk Tidak Ditemukan',
            ], 404);
        }
    }
}
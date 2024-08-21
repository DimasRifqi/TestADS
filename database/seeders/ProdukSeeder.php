<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert([
            [
                'nama' => 'Delicious Pizza A',
                'foto' => 'f1.png',
                'stok' => 25,
                'harga' => 310000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Delicious Burger',
                'foto' => 'f2.png',
                'stok' => 15,
                'harga' => 232000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Delicious Pizza B',
                'foto' => 'f3.png',
                'stok' => 5,
                'harga' => 263000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Delicious Pasta A',
                'foto' => 'f4.png',
                'stok' => 13,
                'harga' => 279000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'French Fries',
                'foto' => 'f5.png',
                'stok' => 8,
                'harga' => 155000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Delicious Pizza C',
                'foto' => 'f6.png',
                'stok' => 5,
                'harga' => 232000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Tasty Burger A',
                'foto' => 'f7.png',
                'stok' => 26,
                'harga' => 185000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Tasty Burger B',
                'foto' => 'f8.png',
                'stok' => 15,
                'harga' => 217000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
            [
                'nama' => 'Delicious Pasta B',
                'foto' => 'f9.png',
                'stok' => 6,
                'harga' => 155000,
                'deskripsi' => 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque',
            ],
        ]);
    }
}
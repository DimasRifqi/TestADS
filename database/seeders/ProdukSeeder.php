<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ProdukKategori::insert([
            [
                'nama' => 'Burger',
            ],
            [
                'nama' => 'Pizza',
            ],
            [
                'nama' => 'Pasta',
            ],
            [
                'nama' => 'Fries',
            ],

        ]);

        Produk::insert([
            [
                'nama' => 'Delicious Pizza A',
                'produk_kategori_id' => 2,
                'foto' => 'f1.png',
                'stok' => 25,
                'harga' => 310000,
                'deskripsi' => 'Pizza dengan keju leleh dan saus tomat yang lezat, sempurna untuk pecinta pizza.',
            ],
            [
                'nama' => 'Delicious Burger',
                'produk_kategori_id' => 1,
                'foto' => 'f2.png',
                'stok' => 15,
                'harga' => 232000,
                'deskripsi' => 'Burger juicy dengan daging sapi premium, dilengkapi dengan sayuran segar.',
            ],
            [
                'nama' => 'Delicious Pizza B',
                'produk_kategori_id' => 2,
                'foto' => 'f3.png',
                'stok' => 5,
                'harga' => 263000,
                'deskripsi' => 'Pizza dengan topping pepperoni yang gurih dan keju mozzarella yang meleleh.',
            ],
            [
                'nama' => 'Delicious Pasta A',
                'produk_kategori_id' => 3,
                'foto' => 'f4.png',
                'stok' => 13,
                'harga' => 279000,
                'deskripsi' => 'Pasta al dente dengan saus carbonara creamy dan taburan keju parmesan.',
            ],
            [
                'nama' => 'French Fries',
                'produk_kategori_id' => 4,
                'foto' => 'f5.png',
                'stok' => 8,
                'harga' => 155000,
                'deskripsi' => 'Kentang goreng renyah dengan sedikit garam, cocok sebagai teman makan.',
            ],
            [
                'nama' => 'Delicious Pizza C',
                'produk_kategori_id' => 2,
                'foto' => 'f6.png',
                'stok' => 5,
                'harga' => 232000,
                'deskripsi' => 'Pizza vegetarian dengan sayuran segar dan saus pesto yang nikmat.',
            ],
            [
                'nama' => 'Tasty Burger A',
                'produk_kategori_id' => 1,
                'foto' => 'f7.png',
                'stok' => 26,
                'harga' => 185000,
                'deskripsi' => 'Burger dengan daging sapi wagyu yang juicy dan saus BBQ spesial.',
            ],
            [
                'nama' => 'Tasty Burger B',
                'produk_kategori_id' => 1,
                'foto' => 'f8.png',
                'stok' => 15,
                'harga' => 217000,
                'deskripsi' => 'Burger dengan patty ayam crispy dan saus mayo pedas.',
            ],
            [
                'nama' => 'Delicious Pasta B',
                'produk_kategori_id' => 3,
                'foto' => 'f9.png',
                'stok' => 6,
                'harga' => 155000,
                'deskripsi' => 'Pasta dengan saus bolognese daging sapi yang kaya rasa dan sedikit taburan keju.',
            ],
        ]);



    }
}
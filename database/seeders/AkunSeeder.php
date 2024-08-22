<?php

namespace Database\Seeders;

use App\Models\HakAkses;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        HakAkses::insert([
            [
                'nama' => 'Buyer',
            ],
            [
                'nama' => 'Seller',
            ],

        ]);


        User::insert([
            [
                'name' => 'Ripqy',
                'hak_akses_id' => 1,
                'email' => 'ripqy@gmail.com',
                'password' => Hash::make('ripqy123456'),
            ],
            [
                'name' => 'Seller',
                'hak_akses_id' => 2,
                'email' => 'seller@gmail.com',
                'password' => Hash::make('seller123456'),
            ],

        ]);
    }
}
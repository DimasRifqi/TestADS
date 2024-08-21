<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'produk_kategori';
    protected $guarded =['id'];


    public function Produk(){

        return $this->hasMany(Produk::class);
    }
}
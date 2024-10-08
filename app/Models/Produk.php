<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'produk';
    protected $guarded =['id'];

    public function ProdukKategori(){

        return $this->belongsTo(ProdukKategori::class);
    }
}
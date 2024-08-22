<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HakAkses extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'hak_akses';
    protected $guarded =['id'];

    public function User(){

        return $this->hasMany(User::class);
    }
}
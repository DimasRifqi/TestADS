<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('produk_kategori_id');
            $table->string('foto');
            $table->unsignedInteger('stok');
            $table->decimal('harga', 15, 3);
            $table->text('deskripsi');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('produk_kategori_id')->references('id')->on('produk_kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
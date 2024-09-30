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
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->string('foto');
            $table->timestamps();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id_cart');
            $table->integer('id_barang');
            $table->integer('jumlah_barang');
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_user');
            $table->string('nama');
            $table->string('alamat');
            $table->text('trans_code');
            $table->integer('id_barang');
            $table->integer('jumlah_barang');
            $table->integer('total_harga');
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_transaksi');
            $table->integer('id_user');
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('order');
    }
};

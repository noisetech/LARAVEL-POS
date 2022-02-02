<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi');
            $table->foreignId('produk_id')->index('fk_transaksi_to_produk');
            $table->integer('jumlah_pembelian');
            $table->integer('tagihan');
            $table->integer('pembayaran')->nullable();
            $table->integer('kembalian')->nullabsle();
            $table->string('status_transaksi')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}

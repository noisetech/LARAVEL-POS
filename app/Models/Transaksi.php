<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    // use HasFactory;

    use SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal_transaksi', 'produk_id', 'jumlah_pembelian', 'tagihan', 'kembalian', 'pembayaran', 'status_transaksi'
    ];

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}

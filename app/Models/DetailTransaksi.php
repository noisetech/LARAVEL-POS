<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id'
    ];
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard_admin(){

         $bahan_total_pembelian = Transaksi::withTrashed()
        ->select(DB::raw('SUM(jumlah_pembelian) as jumlah_pembelian'))
        ->pluck('jumlah_pembelian');

        foreach($bahan_total_pembelian as $btp);
        $lanjutan_bahan_total_pembelian = (int) $btp;


        $total_transaksi = Transaksi::withTrashed()->count();
        $total_produk = Produk::count();
        $total_pelanggan = Pelanggan::count();
        if (!empty($lanjutan_bahan_total_pembelian)) {
            $total_pembelian = $lanjutan_bahan_total_pembelian;
        }else{
            $total_pembelian = 0;
        }




        return view('pages.dashboard', [
            'total_transaksi' => $total_transaksi,
            'total_produk' => $total_produk,
            'total_pelanggan' => $total_pelanggan,
            'total_pembelian' => $total_pembelian
        ]);
    }
}

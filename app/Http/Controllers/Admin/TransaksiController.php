<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Tahun;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function halaman_tambah_transaksi($slug)
    {

        $produk = Produk::where('slug', $slug)->first();

        return view('pages.transaksi.tambah', [
            'produk' => $produk
        ]);
    }

    public function proses_transaksi(Request $request)
    {

        $item = $request->input('nama_produk');

        $produk = Produk::where('nama_produk', $item)->first();

        $harga_jual_produk = $produk->harga_jual;


        Transaksi::create([
            'tanggal_transaksi' => "2021-12-01",
            'produk_id' => $produk->id,
            'jumlah_pembelian' => $request->jumlah_pembelian,
            'tagihan' => $request->jumlah_pembelian * $harga_jual_produk,
            'kembalian' => $request->pembayaran - ($request->tagihan * $harga_jual_produk),
            'status_transaksi' => 'Pending'
        ]);

        return redirect()->route('keseluruhan_transaksi')
            ->with('status_code', 'success')
            ->with('status_text', 'Data ditambahkan')
            ->with('status', 'Berhasil');
    }

    public function keseluruhan_transaksi()
    {
        $transaksi = Transaksi::with(['produk'])->whereNull('deleted_at')->get();
        $data_kembalian = Transaksi::whereNull('deleted_at')->latest()->first();

        if ($transaksi->isEmpty()) {
            return view('pages.transaksi.data', [
                'transaksi' => $transaksi
            ]);
        } else {

            $bahan_tagihan = Transaksi::select(DB::raw('SUM(tagihan) as tagihan'))
                ->get();

            foreach ($bahan_tagihan as $bt) {
                $total_tagihan = $bt->tagihan;
            }

            $pembayaran = Transaksi::whereNull('deleted_at')->latest()->first();


            return view('pages.transaksi.data')
                ->with('transaksi', $transaksi)
                ->with('total_tagihan', $total_tagihan)
                ->with('pembayaran', $pembayaran)
                ->with('data_kembalian', $data_kembalian);
        }
    }


    public function opsi_laporan_pertahun()
    {

        return view('pages.transaksi.opsi_laporan_pertahun');
    }

    public function opsi_laporan_perhari()
    {
        return view('pages.transaksi.opsi_laporan_perhari');
    }

    public function opsi_laporan_perbulan()
    {

        return view('pages.transaksi.opsi_laporan_perbulan');
    }



    public function proses_laporan_pertahun(Request $request)
    {
        $inputan = $request->input('tahun');

        // mendapati data transaksi yang telah selsai
        $transaksi = Transaksi::onlyTrashed()->whereYear('tanggal_transaksi', $inputan)
            ->where('status_transaksi', '=', 'Transaksi selesai')->get();

        if ($transaksi->isEmpty()) {
            return view('pages.transaksi.data-laporan-pertahun', [
                'transaksi' => $transaksi
            ]);
        } else {

            // mencari data jumlah pembelian transaksi yang selsai
            $jumlah_pembelian = Transaksi::onlyTrashed()->whereYear('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('jumlah_pembelian');

            // mencari data total pendapatan transaksi yang selsai
            $total_pendapatan =  Transaksi::onlyTrashed()->whereYear('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('tagihan');

            //    bahan data jumlah transaksi di chart
            $bahan_jumlah_transaksi = Transaksi::onlyTrashed()->select(DB::raw('SUM(jumlah_pembelian) as jumlah_pembelian'))
                ->whereYear('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('jumlah_pembelian');

            foreach ($bahan_jumlah_transaksi as $key => $value) {
                $jumlah_transaksi[] = (int)$value;
            }

            // bahan pendapatan
            $bahan_jumlah_pendapatan = Transaksi::onlyTrashed()->select(DB::raw('SUM(tagihan) as tagihan'))
                ->whereYear('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('tagihan');


            foreach ($bahan_jumlah_pendapatan as $bp) {
                $pendapatan[] = (int)$bp;
            }

            // mencari nama produk untuk chart
            $data_produk = Transaksi::onlyTrashed()->select('produk_id')
                ->whereYear('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('produk_id');



            $produk = Produk::whereIn('id', $data_produk)->select('nama_produk')->pluck('nama_produk');

            $nama_produk = $produk;

            return view('pages.transaksi.data-laporan-pertahun', [
                'transaksi' => $transaksi,
                'jumlah_pembelian' => $jumlah_pembelian,
                'total_pendapatan' => $total_pendapatan,
                'jumlah_pembelian' => $jumlah_pembelian,
                'nama_produk' => $nama_produk,
                'pendapatan' => $pendapatan

            ]);
        }
    }

    public function proses_hapus($id)
    {
        $item = Transaksi::find($id);
        $item->delete();

        return redirect()->route('keseluruhan_transaksi');
    }

    public function proses_laporan_perhari(Request $request)
    {
        $inputan = $request->input('hari');
        // dd($inputan);
        $transaksi = Transaksi::onlyTrashed()->where('status_transaksi', 'Transaksi selesai')
            ->whereDate('tanggal_transaksi', $inputan)
            ->get();

        // dd($transaksi);

        if ($transaksi->isEmpty()) {
            return view('pages.transaksi.data-laporan-perhari', [
                'transaksi' => $transaksi
            ]);
        } else {
            foreach ($transaksi as $t);


            // mencari data jumlah pembelian transaksi yang selsai
            $jumlah_pembelian = Transaksi::onlyTrashed()->whereDate('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('jumlah_pembelian');

            // mencari data total pendapatan transaksi yang selsai
            $total_pendapatan =  Transaksi::onlyTrashed()->whereDate('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('tagihan');

            //    bahan data jumlah transaksi di chart
            $bahan_jumlah_transaksi = Transaksi::onlyTrashed()->select(DB::raw('SUM(jumlah_pembelian) as jumlah_pembelian'))
                ->whereDate('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('jumlah_pembelian');

            foreach ($bahan_jumlah_transaksi as $key => $value) {
                $jumlah_transaksi[] = (int)$value;
            }

            // bahan pendapatan
            $bahan_jumlah_pendapatan = Transaksi::onlyTrashed()->select(DB::raw('SUM(tagihan) as tagihan'))
                ->whereDate('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('tagihan');


            foreach ($bahan_jumlah_pendapatan as $ro) {
                $pendapatan[] = (int)$ro;
            }


            // mencari nama produk untuk chart
            $data_produk = Transaksi::onlyTrashed()->select('produk_id')
                ->whereDate('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->pluck('produk_id');

            $produk = Produk::whereIn('id', $data_produk)->select('nama_produk')->pluck('nama_produk');

            $nama_produk = $produk;


            return view('pages.transaksi.data-laporan-perhari', [
                'transaksi' => $transaksi,
                'jumlah_pembelian' => $jumlah_pembelian,
                'total_pendapatan' => $total_pendapatan,
                'jumlah_transaksi' => $jumlah_transaksi,
                'nama_produk' => $nama_produk,
                'pendapatan' => $pendapatan
            ]);
        }
    }

    public function proses_laporan_perbulan(Request $request)
    {
        $inputan = $request->input('bulan');
        $inputan2 = $request->input('tahun');


        $transaksi = Transaksi::onlyTrashed()->where('status_transaksi', 'Transaksi selesai')
            ->whereYear('tanggal_transaksi', $inputan2)
            ->whereMonth('tanggal_transaksi', $inputan)
            ->get();

        if ($transaksi->isEmpty()) {
            return view('pages.transaksi.data-laporan-perbulan', [
                'transaksi' => $transaksi
            ]);
        } else {
            // mencari data jumlah pembelian transaksi yang selsai
            $jumlah_pembelian = Transaksi::onlyTrashed()
                ->whereYear('tanggal_transaksi', $inputan2)
                ->whereMonth('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('jumlah_pembelian');

            // mencari data total pendapatan transaksi yang selsai
            $total_pendapatan =  Transaksi::onlyTrashed()
                ->whereYear('tanggal_transaksi', $inputan2)
                ->whereMonth('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')->sum('tagihan');

            //    bahan data jumlah transaksi di chart
            $bahan_jumlah_transaksi = Transaksi::onlyTrashed()->select(DB::raw('SUM(jumlah_pembelian) as jumlah_pembelian'))
                ->whereYear('tanggal_transaksi', $inputan2)
                ->whereMonth('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('jumlah_pembelian');

            foreach ($bahan_jumlah_transaksi as $key => $value) {
                $jumlah_transaksi[] = (int)$value;
            }

            // bahan pendapatan
            $bahan_jumlah_pendapatan = Transaksi::onlyTrashed()->select(DB::raw('SUM(tagihan) as tagihan'))
                ->whereYear('tanggal_transaksi', $inputan2)
                ->whereMonth('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->groupBy('produk_id')
                ->pluck('tagihan');


            foreach ($bahan_jumlah_pendapatan as $ro) {
                $pendapatan[] = (int)$ro;
            }


            // mencari nama produk untuk chart
            $data_produk = Transaksi::onlyTrashed()->select('produk_id')
                ->whereYear('tanggal_transaksi', $inputan2)
                ->whereMonth('tanggal_transaksi', $inputan)
                ->where('status_transaksi', '=', 'Transaksi selesai')
                ->pluck('produk_id');

            $produk = Produk::whereIn('id', $data_produk)->select('nama_produk')->pluck('nama_produk');

            $nama_produk = $produk;



            return view('pages.transaksi.data-laporan-perbulan', [
                'transaksi' => $transaksi,
                'jumlah_pembelian' => $jumlah_pembelian,
                'total_pendapatan' => $total_pendapatan,
                'jumlah_transaksi' => $jumlah_transaksi,
                'nama_produk' => $nama_produk,
                'pendapatan' => $pendapatan
            ]);
        }
    }

    public function input_pembayaran()
    {
        $transaksi = Transaksi::whereNull('deleted_at')->first();

        if (empty($transaksi)) {
            return redirect()->back()
                ->with('status_code', 'error')
                ->with('status_text', 'Input dahulu transaksi')
                ->with('status', 'Terjadi kesalahan');
        }

        return view('pages.transaksi.input-pembayaran');
    }

    public function proses_pembayaran(Request $request)
    {
        $transaksi = Transaksi::whereNull('deleted_at')->latest()->first();
        $tagihan = Transaksi::select(DB::raw('SUM(tagihan) as tagihan'))->whereNull('deleted_at')->pluck('tagihan');
        $pembayaran = $request->pembayaran;


        foreach ($tagihan as $key => $value) {
            if ($pembayaran < $value) {
                return redirect()->back()
                    ->with('status_code', 'error')
                    ->with('status_text', 'Pembayaran Anda Kurang')
                    ->with('error', 'Maaf');
            }
            $kembalian = $pembayaran - $value;
        }

        Transaksi::where('id', $transaksi->id)
            ->update([
                'pembayaran' => $pembayaran
            ]);

        Transaksi::where('id', $transaksi->id)
            ->update([
                'status_transaksi' => 'Sudah bayar'
            ]);

        Transaksi::where('id', $transaksi->id)
            ->update([
                'kembalian' => $kembalian
            ]);

        return redirect()->route('keseluruhan_transaksi')
            ->with('status_code', 'success')
            ->with('status_text', 'Input pembayaran')
            ->with('status', 'Berhasil');
    }

    public function selsai_transaksi()
    {
        $transaksi = Transaksi::whereNull('deleted_at')->pluck('id');

        Transaksi::whereIn('id', $transaksi)->update([
            'status_transaksi' => 'Transaksi selesai'
        ]);

        Transaksi::whereIn('id', $transaksi)->delete();

        return redirect()->route('keseluruhan_transaksi')
            ->with('status_code', 'success')
            ->with('status_text', 'Transaksi selesai')
            ->with('status', 'Berhasil');
    }

    public function cancel()
    {
        $transaksi = Transaksi::whereNull('deleted_at')->pluck('id');

        foreach ($transaksi as $key => $value) {
            $transaksi_id = $value;
        }

        Transaksi::whereIn('id', $transaksi)->update([
            'status_transaksi' => 'Transaksi dibatalkan'
        ]);


        Transaksi::whereIn('id', $transaksi)->delete();

        return redirect()->route('keseluruhan_transaksi')
            ->with('status_code', 'success')
            ->with('status_text', 'Transaksi dibatalkan')
            ->with('status', 'Berhasil');
    }


    public function cari(Request $request)
    {


        $produk = Produk::where('nama_produk', $request->input('nama_produk'))->get();

        if ($produk->isEmpty()) {
            return redirect()->back()
                ->with('status_code', 'error')
                ->with('status_text', 'Data Tersebut tida tersedia')
                ->with('status', 'Maaf');
        }

        return view('pages.transaksi.pencarian', [
            'produk' => $produk
        ]);
    }
}

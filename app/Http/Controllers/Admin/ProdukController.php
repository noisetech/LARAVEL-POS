<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function data(){
        $items = Produk::orderBy('id', 'ASC')->paginate(8);

        return view('pages.produk.data', [
            'items' => $items
        ]);
    }

    public function halaman_tambah(){
        return view('pages.produk.tambah');
    }

    public function proses_tambah(Request $request){

        $this->validate($request, [
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga_modal' => 'required',
            'harga_jual' => 'required'
        ]);


        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_produk);

        Produk::create($data);

        return redirect()->route('halaman.data.produk.admin')
        ->with('status_code', 'success')
        ->with('status_text', 'Data ditambahkan')
        ->with('status', 'Berhasil');
    }

    public function ubah($id){
        $item = Produk::find($id);

        return view('pages.produk.edit', [
            'item' => $item
        ]);
    }

    public function proses_ubah(Request $request, $id){


        $item = Produk::find($id);

        $data = $request->all();

        $item->update($data);

        return redirect()->route('halaman.data.produk.admin')
        ->with('status_code', 'success')
        ->with('status_text', 'Data diubah')
        ->with('status', 'Berhasil');

    }


    public function proses_hapus($id){
        $item = Produk::find($id);

        Transaksi::where('produk_id', $item->id)->delete();

        $item->delete();

        return redirect()->route('halaman.data.produk.admin')
        ->with('status_code', 'success')
        ->with('status_text', 'Data dihapus')
        ->with('status', 'Berhasil');
    }

}

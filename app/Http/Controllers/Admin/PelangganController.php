<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function tambah()
    {
        return view('pages.pelanggan.tambah');
    }

    public function proses_tambah(Request $request)
    {
        $data = $request->all();

        Pelanggan::create($data);

        return redirect()->route('data.pelanggan.admin')
            ->with('status_code', 'success')
            ->with('status_text', 'Data ditambahkan')
            ->with('status', 'Berhasil');
    }

    public function data()
    {
        $items = Pelanggan::all();
        return view('pages.pelanggan.data', [
            'items' => $items
        ]);
    }

    public function ubah($id)
    {
        $item = Pelanggan::find($id);

        // dd($item);

        return view('pages.pelanggan.edit', [
            'item' => $item
        ]);
    }

    public function proses_ubah(Request $request, $id)
    {
        $item = Pelanggan::find($id);

        $data = $request->all();

        $item->update($data);

        return redirect()->route('data.pelanggan.admin')
            ->with('status_code', 'success')
            ->with('status_text', 'Data ditambahkan')
            ->with('status', 'Berhasil');
    }

    public function proses_hapus($id)
    {
        $item = Pelanggan::find($id);

        $item->delete();


        return redirect()->route('data.pelanggan.admin')
            ->with('status_code', 'success')
            ->with('status_text', 'Data ditambahkan')
            ->with('status', 'Berhasil');
    }
}

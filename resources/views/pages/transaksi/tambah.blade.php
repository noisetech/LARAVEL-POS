@extends('layouts.admin')
@section('title', 'Tambah Transaksi')
@section('content')
    <div class="container-fluid">

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black-50">
                        Menginput transaksi
                    </h6>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('proses_transaksi') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="form-control">
                                </div>

                            <div class="form-group">
                            <label for="">Harga Produk</label>
                            <input type="number" name="harga_produk" value="{{ $produk->harga_jual }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Jumlah Pembelian</label>
                                <input type="number" name="jumlah_pembelian" class="form-control"
                                    placeholder="Jumlah Pembelian">
                            </div>


                            <button class="btn btn-sm btn-primary" type="submit">
                                Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

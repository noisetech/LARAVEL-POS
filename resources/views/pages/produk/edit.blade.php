@extends('layouts.admin')
@section('title', 'Ubah Produk')
@section('content')
    <div class="container-fluid">

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black-50">
                        Tambah data produk
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('proses.ubah.data.produk.admin', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="">Nama Produk:</label>
                                <input type="text" name="nama_produk" class="form-control" value="{{ $item->nama_produk }}">
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" rows="10">{{ $item->deskripsi }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="">Harga Modal:</label>
                                <input type="number" name="harga_modal" class="form-control" placeholder="Harga Modal" value="{{ $item->harga_modal }}">
                            </div>

                            <div class="form-group">
                                <label for="">Harga Jual:</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" value="{{ $item->harga_jual }}">
                            </div>




                            <button class="btn btn-sm btn-warning" type="submit">
                                Ubah
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

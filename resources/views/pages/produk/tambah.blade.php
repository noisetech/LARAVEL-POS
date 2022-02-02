@extends('layouts.admin')
@section('title', 'Tambah Produk')
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
                        <form action="{{ route('proses.tambah.data.produk.admin') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Nama Produk:</label>
                                <input type="text" name="nama_produk"
                                    class="form-control @error('nama_produk') is-invalid @enderror"
                                    value="{{ old('nama_produk') }}">
                                @error('nama_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                    rows="10"></textarea>
                                @error('deskripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="">Harga Modal:</label>
                                <input type="number" name="harga_modal"
                                    class="form-control @error('harga_modal') is-invalid @enderror"
                                    placeholder="Harga Modal" value="{{ old('harga_modal') }}">
                                @error('harga_modal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Harga Jual:</label>
                                <input type="number" name="harga_jual"
                                    class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Harga Jual"
                                    value="{{ old('harga_jual') }}">
                                @error('harga_modal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-sm btn-primary" type="submit">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

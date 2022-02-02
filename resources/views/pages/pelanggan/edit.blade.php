@extends('layouts.admin')
@section('title', 'Ubah Pelanggan')
@section('content')
    <div class="container-fluid">

               <!-- DataTales Example -->
               <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black-50">
                        Menginput Pelanggan
                    </h6>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('prosesubah.pelanggan.admin', $item->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Nama" value="{{ $item->nama_lengkap }}">
                            </div>

                            <div class="form-group">
                                <label for="">Nomor telepon</label>
                                <input type="text" name="nomor_telepon" class="form-control"
                                    placeholder="Nomor Telepon" value="{{ $item->nomor_telepon }}">
                            </div>


                            <button class="btn btn-sm btn-warning" type="submit">
                                Ubah
                            </button>
                        </form>
                    </div>
                </div>
            </div>


    </div>
@endsection

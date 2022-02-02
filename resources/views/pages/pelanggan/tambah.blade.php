@extends('layouts.admin')
@section('title', 'Tambah Pelanggan')
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
                        <form action="{{ route('proses.tambah.pelanggan.admin') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Nama">
                            </div>


                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="text" name="nomor_telepon" class="form-control"
                                    placeholder="No Telepon">
                            </div>


                            <button class="btn btn-sm btn-primary" type="submit">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>


    </div>
@endsection

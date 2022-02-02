@extends('layouts.admin')
@section('title', 'Opsi Laporan Perhari')
@section('content')
    <div class="container-fluid">

        <div class="container-fluid">



            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black-50">
                        Opsi Laporan Transaksi Perhari
                    </h6>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('proses_laporan_perhari') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="hari" class="form-control">
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

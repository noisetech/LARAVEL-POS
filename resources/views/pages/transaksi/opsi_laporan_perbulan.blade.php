@extends('layouts.admin')
@section('title', 'Opsi Laporan Perbulan')
@section('content')
    <div class="container-fluid">

        <div class="container-fluid">



            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black-50">
                        Opsi Laporan Transaksi Perbulan
                    </h6>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('proses_laporan_perbulan') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Febuari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">Septer</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>

                                </select>
                            </div>



                            <div class="form-group">
                                <label for="">Tahun</label>
                                <input type="text" name="tahun" class="form-control" placeholder="Ketika data periode tahun ke berapa">
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

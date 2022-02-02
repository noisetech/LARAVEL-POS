@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halaman Dashboard Admin</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_produk }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_transaksi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Pelaggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pelanggan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pembelian }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->


    <div class="row m-2">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
              <h5 class="card-title">Visi</h5>
              <p class="card-text">Menyehatkan masyarakat dengan produk-produk yang alami, berkualitas, relatif murah, dan dengan reaksi efek yang cepat.</p>
            </div>
          </div>
    </div>

    <div class="row m-2 mb-5">
        <div class="card" style="width: 50rem;">
            <div class="card-body">
              <h5 class="card-title">Misi</h5>
              <p class="card-text">Solusi keuangan kepada masyarakat indonesia dengan menciptakan peluang sistem penjualan berjenjang yang revolusioner dan berpihak kepada member yang dituangkan di dalam marketing planyang sederhana, tanpa janji muluk, bonus dibayar cepat, bonus dibayar besar, bonus dibayar tanpa syarat tutup poin serta belanja otomatis.
                <br>
                Konsep berpihak kepada member merupakan landasan bisnis MLM Melia Sehat Sejahtera. Hal inilah yang menjadi landasan bagi perusahaan untuk roda perusahaannya.</p>
            </div>
          </div>
    </div>


</div>
@endsection

@push('script')
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Anda yakin?',
                text: 'Data akan terhapus!',
                icon: 'warning',
                dangerMode: true,
                buttons: ["Tidak", "Hapus!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>

    <script>
        @if (session('status'))
            swal({
            title: "{{ session('status') }}",
            text: "{{ session('status_text') }}",
            icon: "{{ session('status_code') }}",
            buttons: false
            });
            setTimeout(window.location.reload.bind(window.location), 2500);
        @endif
    </script>
@endpush

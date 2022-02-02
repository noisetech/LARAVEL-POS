@extends('layouts.admin')
@section('title', 'Transaksi')
@section('content')
    <div class="container-fluid">


        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="d-flex justify-content-between">
                            <p>Cari produk</p>
                        </div>
                    </h6>
                </div>
                <div class="card-body">
                    {{-- <div class="table-responsive">
                        <form action="{{ route('proses_transaksi') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Nama Produk:</label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk">
                            </div>

                            <div class="form-group">
                                <label for="">Jumlah Pembelian:</label>
                                <input type="text" name="jumlah_pembelian" class="form-control" placeholder="Nama Produk">
                            </div>

                            <button class="btn btn-sm btn-primary" type="submit">
                                Tambah
                            </button>
                        </form>
                    </div> --}}

                    <form class="form-inline" action="{{ route('cari-data-produk') }}" method="POST">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="nama_produk" required class="form-control"
                                placeholder="Masukan Nama Produk">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" type="submit">
                            <i class="fas fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="d-flex justify-content-between">
                            <p>Data Transaksi</p>
                        </div>


                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Status Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>
                                            @if (empty($item))

                                            @else
                                                {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->isoFormat('DD-MM-Y') }}
                                            @endif
                                        </td>
                                        <td>{{ $item->produk->nama_produk }}</td>
                                        <td> Rp.{{ number_format($item->produk->harga_jual, 2, ',', '.') }}</td>
                                        <td>
                                            {{ $item->jumlah_pembelian }}
                                        </td>
                                        <td>{{ $item->status_transaksi }}</td>
                                        <td>
                                            <a href="" class="badge badge-secondary">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Data Transaksi Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="row justify-content-center mb-5">
            <div class="col-sm-10 col-lg-6">
                @if ($transaksi->isEmpty())

                @else
                <div class="card" style="width: 350px;">
                    <div class="card-body">
                        <div class="row ml-5">
                            <div class="col">
                                <a href="{{ route('selsai_transaksi') }}" class="badge  badge-success">Selesai</a>
                                <a href="{{ route('input_pembayaran') }}"
                                    class="badge  badge-warning">Pembayaran</a>
                                <a href="{{ route('cancel') }}"
                                    class="badge  badge-danger cancel-trannsaksi">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-sm-10 col-lg-3 mt-4 ">
                <div class="card bg-gray-600" style="width: 18rem;">
                    <div class="card-body border-white">
                        <h5 class="card-title text-white">Total Tagihan Anda</h5>
                        <p class="card-text text-white">
                            @if (empty($total_tagihan))

                            @else
                                Berjumlah: Rp.{{ number_format($total_tagihan, 2, ',', '.') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-bottom: 80px;">
            <div class="col-sm-10 col-lg-6">
                <div class="card" style="width: 350px;" hidden>
                    <div class="card-body" hidden>

                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-3 mt-2 ">
                <div class="card bg-gray-600" style="width: 18rem;">
                    <div class="card-body border-white">
                        <p class="card-title text-white">Uang Pembayaran:</p>
                        <p class="card-text text-white">
                            @if (empty($pembayaran->pembayaran))

                            @else
                                Berjumlah: Rp.{{ number_format($pembayaran->pembayaran, 2, ',', '.') }}
                            @endif
                        </p>
                        <p class="card-title text-white">Kembalian:</p>
                        <p class="card-text text-white">
                            @if (empty($data_kembalian->kembalian))

                            @else
                                Berjumlah: Rp.{{ number_format($data_kembalian->kembalian, 2, ',', '.') }}
                            @endif
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script>
        $('.cancel-trannsaksi').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Yakin Batal Transaksi?',
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

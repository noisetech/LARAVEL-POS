@extends('layouts.admin')
@section('title', 'Data Produk')
@section('content')
<style type="text/css">

</style>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <div class="d-flex justify-content-between">
                        {{-- <form class="form-inline" action="{{ route('cari-data-produk') }}" method="POST">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="nama_produk" class="form-control" id="inputPassword2"
                                    placeholder="Cari Produk">
                            </div>
                            <button type="submit" class="btn btn-success mb-2">Cari</button>
                        </form> --}}
                        <a href="{{ route('halaman.tambah.data.produk.admin') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-sm fa-plus-circle"> Tambah data</i>
                        </a>


                    </div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga Modal</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $produk => $item)
                            <tr>
                                <td>{{ $item['id']}}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if (empty($item))

                                    @else
                                        Rp. {{ number_format($item->harga_modal, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if (empty($item))

                                    @else
                                        Rp. {{ number_format($item->harga_jual, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('halaman.ubah.data.produk.admin', $item->id) }}"
                                        class="badge badge-warning">
                                        Edit
                                    </a>

                                    <a href="{{ route('proses.hapus.data.produk.admin', $item->id) }}"
                                        class="badge badge-danger delete-confirm">
                                        Hapus
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$items->links("pagination::bootstrap-4")}}
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

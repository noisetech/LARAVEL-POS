@extends('layouts.admin')

@section('title', 'Data Pelanggan')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
        </div>


        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('tambah.data.pelanggan.admin') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-sm fa-plus-circle"> Tambah data</i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $data => $item)
                                <tr>
                                    <td>{{ $data+1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nomor_telepon }}</td>
                                    <td>
                                        <a href="{{ route('ubah.pelanggan.admin', $item->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-sm fa-pencil-alt"> </i>
                                        </a>

                                        <a href="{{ route('proseshapus.pelanggan.admin', $item->id) }}"
                                            class="btn btn-sm btn-danger delete-confirm">
                                            <i class="fas fa-sm fa-trash-alt"> </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

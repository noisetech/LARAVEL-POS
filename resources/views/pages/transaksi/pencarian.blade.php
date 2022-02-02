@extends('layouts.admin')
@section('title', 'Produk Bedasarkan Pencarian')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->

        {{-- <div class="d-sm-flex align-items-center justify-content-end mr-5 mb-3">
            <a href="{{ route('halaman.tambah.data.produk.admin') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-sm fa-plus-circle"></i>
            </a>
        </div> --}}

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="d-flex justify-content-between">
                            <p>Data produk berdasarkan pencarian</p>
                        </div>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produk as $item)
                                    <tr>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @if (empty($item))
                                            @else
                                              Rp.{{ number_format($item->harga_modal, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($item))
                                            @else
                                              Rp.{{ number_format($item->harga_jual, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ route('halaman.transaksi', $item->slug) }}"
                                                class="btn btn-sm btn-secondary">
                                                Input Transaksi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Data yang dicari tidak ada </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

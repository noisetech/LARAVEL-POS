@extends('layouts.admin')
@section('title', 'Laporan Perbulan')
@section('content')
    <div class="container-fluid">


        <div class="container-fluid">

            <!-- DataTales Example -->
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
                            {{-- <a href="{{ route('halaman.tambah.data.produk.admin') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-sm fa-plus-circle">Tambah data</i>
                            </a> --}}

                            <p>Laporan Transaksi Perhari</p>

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
                                    <th>Harga Jual</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Total Tagihan</th>
                                    <th>Pembayaran</th>
                                    <th>Kembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->isoFormat('MMMM Y') }}
                                        </td>
                                        <td>{{ $item->produk->nama_produk }}</td>
                                        <td>
                                            @if (empty($item))

                                            @else
                                                Rp.{{ number_format($item->produk->harga_jual, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>{{ $item->jumlah_pembelian }}</td>
                                        <td>
                                            @if (empty($item))

                                            @else
                                                Rp.{{ number_format($item->tagihan, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($item))

                                            @else
                                                Rp.{{ number_format($item->pembayaran, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($item))

                                            @else
                                                Rp.{{ number_format($item->kembalian, 2, ',', '.') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-lg-flex justify-content-end mb-5">
                <div class="col-sm-10 col-lg-5 mt-4">
                    <div class="card bg-gray-600" style="width: 22rem;">
                        <div class="card-body border-white">
                            <p style="font-size: 14px;" class="card-title text-white">Total pembelian transaksi hari ini:
                                @if (empty($jumlah_pembelian))
                                @else
                                    <br>
                                    Sebanyak {{ $jumlah_pembelian }}
                                @endif
                            </p>
                            <p style="font-size: 14px;" class="card-title text-white">Total pendapatan transaksi hari ini:
                                @if (empty($total_pendapatan))
                                @else
                                    <br>
                                    Rp. {{ number_format($total_pendapatan, 2, ',', '.') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if ($transaksi->isEmpty())

@else

<div id="container">

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Pembelian PerBarang'
        },
        xAxis: {
            categories: {!! json_encode($nama_produk) !!}
        },
        yAxis: {
            title: {
                text: 'Jumlah Nilai'
            }
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Pembelian',
            data: {!! json_encode($jumlah_transaksi) !!},
        }]
    });
</script>

<div id="container2" style="margin-top:100px;">

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    Highcharts.chart('container2', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Grafi Pendapatan Perhari Produk'
        },
        xAxis: {
            categories: {!! json_encode($nama_produk) !!},
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Pendapatan'
            }
        },
        tooltip: {
            split: true,
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'Total Pendapatan',
            data: {!! json_encode($pendapatan) !!}
        }]
    });
</script>
@endif
@endsection

@extends('layouts.admin')

@section('title', 'Uang Pembayaran')
@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Input Uang Pembayaran
            </div>
            <div class="card-body">
                <form action="{{ route('proses_pembayaran') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">Uang Pembayaran</label>
                        <input type="number" name="pembayaran" class="form-control" placeholder="Uang Pembayaran">
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>



    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script>
        @if (session('error'))
            swal({
            title: "{{ session('error') }}",
            text: "{{ session('status_text') }}",
            icon: "{{ session('status_code') }}",
            buttons: false
            });
            setTimeout(window.location.reload.bind(window.location), 2500);
        @endif
    </script>
@endpush

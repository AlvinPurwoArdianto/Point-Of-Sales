@extends('layouts.frontend')
@section('content')
<div class="row">
    <div class="rekapan col-12 col-lg-12 d-flex">
        <div class="card w-100 ">
            <div class="card-body">
                <nav class="navbar navbar-expand align-items-center gap-4">
                    <h2 class="fw-bold" style="margin-left: 20px">Rekapan Transaksi</h2>
                </nav>
                <hr>
                <div class="card-body">
                    <div class="d-flex flex-lg-row flex-column align-items-start align-items-lg-center justify-content-between gap-3">
                        <div class="flex-grow-1">
                            <form action="{{ route('filter') }}" method="GET" class="mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="tgl_mulai" class="form-label">Mulai Tanggal:</label>
                                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="tgl_selesai" class="form-label">Akhir Tanggal:</label>
                                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                                    </div>
                                    <div class="col-md-2 align-self-end">
                                        <button type="submit" class="btn btn-success">Filter</button>
                                        <a href="{{ route('rekapan') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="overflow-auto">
                            <div class="btn-group position-static">
                                <div class="btn-group position-static">
                                    <a href="{{route('cetak-rekapan')}}" class="btn btn-primary" target="_blank">
                                        <i class="bi bi-printer-fill me-2"></i>Print
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <hr>
                <div class="product-table m-4">
                    <div class="table-responsive">
                        <table class="table" id="example2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Nama Kasir</th>
                                    {{-- <th scope="col">Jumlah</th> --}}
                                    {{-- <th scope="col">Subtotal</th>
                                    <th scope="col">Pajak</th> --}}
                                    <th scope="col">Total</th>
                                    <th scope="col">Bayar</th>
                                    <th scope="col">Kembali</th>
                                    <th scope="col">Tanggal Transakasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekapan as $data)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $data->menu }}</td>
                                    <td>{{ $data->id_user }}</td>
                                    {{-- <td>{{ $data->jumlah }}</td> --}}
                                    {{-- <td>{{ $data->subtotal }}</td>
                                    <td>{{ $data->pajak }}</td> --}}
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->bayar }}</td>
                                    <td>{{ $data->kembali }}</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 pb-3 ms-auto" style="overflow-y: hidden">
                <a href="{{ route('kasir') }}" class="btn btn-danger px-4">
                    Kembali
                </a>
            </div>
            @endsection

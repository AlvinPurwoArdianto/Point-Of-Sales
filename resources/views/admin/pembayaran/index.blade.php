@extends('layouts.backend')
@section('content')
    <h3 class="mb-0 text-uppercase pb-3">Rekapan Pembayaran</h3>
    <hr>
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <div class="col-lg-3 pb-3 ms-auto">
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary px-4 raised d-flex gap-2">
        Tambah Pembayaran
        </a>
    </div> --}}
            <div class="flex-grow-1">
                <form action="{{ route('pembayaran.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="tgl_mulai" class="form-label">Mulai Tanggal:</label>
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                                value="{{ request('tgl_mulai') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="tgl_selesai" class="form-label">Akhir Tanggal:</label>
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai"
                                value="{{ request('tgl_selesai') }}">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <a href="{{ route('pembayaran.index') }}" class="btn btn-primary">Reset</a>
                        </div>
                    </div>
                </form>

            </div>
            <table class="table mb-0 table-striped" id="example2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Nama Kasir</th>
                        {{-- <th scope="col">Jumlah</th> --}}
                        <th scope="col">Subtotal</th>
                        <th scope="col">Pajak</th>
                        <th scope="col">Total</th>
                        <th scope="col">Bayar</th>
                        <th scope="col">Kembali</th>
                        <th scope="col">Tanggal Transakasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $data)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $data->menu }}</td>
                            <td>{{ $data->id_user }}</td>
                            {{-- <td>{{ $data->jumlah }}</td> --}}
                            <td><strong>Rp.{{ number_format($data->subtotal, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp.{{ number_format($data->pajak, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp.{{ number_format($data->total, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp.{{ number_format($data->bayar, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp.{{ number_format($data->kembali, 0, ',', '.') }}</strong></td>
                            <td><strong>{{ $data->created_at }}</strong></td>
                            <td>
                                <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('pembayaran.edit', $data->id) }}"
                                        class="btn btn-warning px-2">Edit</a>
                                    <button type="submit" class="btn btn-danger px-2"
                                        onclick="return confirm('Apakah anda yakin??')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <center>Total Pembayaran</center>
                        </td>
                        <td>
                            <center>:</center>
                        </td>
                        <td colspan="5"><strong>Rp.{{ number_format($totalBayar, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
@endsection

@extends('layouts.backend')
@section('content')
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Tambah Pembayaran</h5>
                <form class="row g-3" method="POST" action="{{ route('pembayaran.store') }}">
                    @csrf

                    @if ($errors->has('nama_pembayaran'))
                        <div class="alert alert-danger">
                            {{ $errors->first('nama_pembayaran') }}
                        </div>
                    @endif

                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Nama Menu</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="menu" placeholder="Menu" required>
                        </div>
                    </div>
                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Subtotal</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="subtotal" placeholder="Subtotal" required>
                        </div>
                    </div>
                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Pajak</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="pajak" placeholder="Pajak" required>
                        </div>
                    </div>

                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Total</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="total" placeholder="Total" required>
                        </div>
                    </div>

                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Bayar</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="bayar" placeholder="Bayar" required>
                        </div>
                    </div>

                    <div class="col-md-4x">
                        <label for="input13" class="form-label">Kembali</label>
                        <div class="position-relative">
                            <input class="form-control mb-3" type="text" name="kembali" placeholder="Kembali" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <a href="{{ route('pembayaran.index') }}" class="btn btn-danger px-4">Batal</a>
                            <button type="submit" class="btn btn-success px-4">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

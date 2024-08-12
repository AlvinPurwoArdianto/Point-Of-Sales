@extends('layouts.backend')
@section('content')
<div class="col-12 col-xl-12">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Tambah Menu</h5>
            <form class="row g-3" method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->has('menu'))
                <div class="alert alert-danger">
                    {{ $errors->first('menu') }}
                </div>
                @endif  

                <div class="col-md-4x">
                    <label for="input13" class="form-label">Nama Menu</label>
                    <div class="position-relative">
                        <input class="form-control mb-3" type="text" name="menu" placeholder="Nama menu" required>
                    </div>
                </div>

                <div class="col-md-4x">
                    <label for="input13" class="form-label">Kategori</label>
                    <div class="position-relative ">
                        <select class="form-control mb-3" name="id_kategori" placeholder="Kategori" required>
                            @foreach ($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_kategori }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4x">
                    <label for="input13" class="form-label">Harga</label>
                    <div class="position-relative ">
                        <input class="form-control mb-3" type="number" name="harga" placeholder="Harga" required>
                    </div>
                </div>
                <div class="col-md-4x">
                    <label for="input13" class="form-label">Foto</label>
                    <div class="position-relative ">
                        <input class="form-control mb-3" type="file" name="gambar" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <a href="{{route('menu.index')}}" class="btn btn-danger px-4">Batal</a>
                        <a href="{{route('menu.create')}}" class="btn btn-grd btn-primary px-4 ">Reset</a>
                        <button type="submit" class="btn btn-success px-4">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

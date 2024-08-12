@extends('layouts.backend')
@section('content')
<div class="col-12 col-xl-12">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Menu <span class="text-primary">{{ $menu->menu }}</span></h5>

            <form class="row g-3" method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="col-md-4x">
                    <label for="input13" class="form-label">Nama Menu</label>
                    <div class="position-relative">
                        <input class="form-control mb-3" type="text" name="menu" placeholder="Nama menu" value="{{$menu->menu}}" required>
                    </div>
                </div>
                <div class="col-md-4x">
                    <label for="input13" class="form-label">Kategori</label>
                    <div class="position-relative">
                        <select class="form-control mb-3" name="id_kategori" placeholder="Kategori" value="{{$menu->kategori}}" required>
                            @foreach ($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4x">
                    <label for="input13" class="form-label">Harga</label>
                    <div class="position-relative">
                        <input class="form-control mb-3" type="text" name="harga" placeholder="Harga" value="{{$menu->harga}}" required>
                    </div>
                </div>
                <div class="col-md-4x">
                    <label for="input13" class="form-label">Foto</label>
                    <div class="position-relative">
                        <img src="{{ asset('images/menu/' . $menu->gambar) }}" class="pb-5" width="500" height="300" style="object-fit: cover;" alt="">
                        <input class="form-control mb-3" type="file" name="gambar" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <a href="{{route('menu.index')}}" class="btn btn-danger px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.backend')
@section('content')
<h3 class="mb-0 text-uppercase pb-3">TABEL MENU</h3>
<hr>
<div class="card">
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <a href="{{ route('menu.create') }}" class="btn btn-grd btn-primary px-5 mb-2">Tambah Data Menu</a>
        <table class="table mb-0 table-striped" id="example">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama menu</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $data)
                <tr>
                    <th scope="row">{{ $loop->index+1 }}</th>
                    <td>{{ $data->menu }}</td>
                    <td>{{ $data->kategori->nama_kategori }}</td>
                    <td>{{ $data->harga }}</td>
                    <td>
                        <img src="{{ asset('images/menu/' . $data->gambar) }}" width="200" height="100" style="object-fit: cover;" alt="">
                    </td>
                    <td>
                        <form action="{{ route('menu.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('menu.edit', $data->id) }}" class="btn btn-warning px-5">Edit</a>
                            <button type="submit" class="btn btn-danger px-5" onclick="return confirm('Apakah anda yakin??')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

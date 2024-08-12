@extends('layouts.frontend')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-8 d-flex" style="margin-left:0.5rem;margin-top: -1rem">
            <div class="card w-100 ">
                <div class="card-body">
                    <nav class="navbar navbar-expand align-items-center gap-4">
                        <h2 class="fw-bold" style="margin-left: 20px">Daftar Menu</h2>
                        <div class="search-bar flex-grow-1" style="padding-left: 30rem">
                            <div class="position-relative">
                                <input id="searchInput" class="form-control rounded-5 px-5 search-control" type="search"
                                    placeholder="Cari Menu">
                                <span
                                    class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                            </div>
                        </div>
                    </nav>
                    <hr>
                    <div class="product-table">
                        <div class="table-responsive">
                            <div
                                style=" overflow-x: hidden; overflow-y: scroll; width:100%px; height:380px; padding-left:50px; border:1px solid white">
                                <div class="row row-cols-1 row-cols-xl-5">
                                    <!-- Tambahkan event listener pada gambar di dalam loop foreach -->
                                    @foreach ($menu as $data)
                                        <div class="card">
                                            <div class="img-hover-zoom"
                                                onclick="tampilkanInfo('{{ $data->menu }}', {{ $data->harga }})">
                                                <img src="{{ asset('images/menu/' . $data->gambar) }}">
                                            </div>
                                            <div class="pt-3">
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-text">{{ $data->menu }}</p>
                                                    <p class="kategori">{{ $data->kategori->nama_kategori }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p class="fw-semi-bold"></p>
                                                    <p class="card-text">Rp. {{ $data->harga }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            {{-- kategori --}}
                            <div class="card-body">
                                <div style=" overflow-x: scroll; overflow-y: hidden; width:100%px; padding-bottom:1rem;">
                                    <div class="row row-cols-auto g-2">
                                        @foreach ($kategori as $data)
                                            <div class="col">
                                                <button type="button" class="btn btn-primary px-5 p-4"
                                                    onclick="tampilkanMenu('{{ $data->nama_kategori }}')">{{ $data->nama_kategori }}</button>
                                            </div>
                                        @endforeach
                                        <div class="col">
                                            <button type="button" class="btn btn-danger px-5 p-4"
                                                onclick="resetKategori()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Kategori --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex" style="margin-left:-1rem;margin-top: -1rem">
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 fw-bold">Pesanan</h4>
                        <div
                            style=" overflow-x: hidden; overflow-y: scroll; width:100%px; height:274px; border:1px solid white ">
                            <table id="orderStatusTable" class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <input class="form-check-input ms-0" type="checkbox" id="selectAllCheckbox">
                                        </th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- untuk isinya ada pada JS -->
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-danger px-5" onclick="hapusPesanan()">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between">
                                <p class="fw-semi-bold">Subtotal :</p>
                                <p class="fw-semi-bold" id="subtotal">Rp. 0</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="fw-semi-bold">Pajak :</p>
                                <p class="fw-semi-bold" id="pajak">Rp. 0</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-4">
                            <h5 class="mb-0 fw-bold">Total :</h5>
                            <h5 class="mb-0 fw-bold" id="totalAkhir">Rp. 0</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-cols-auto g-4 justify-content-space-between">
                            <div class="col">
                                <a href="{{ route('kasir') }}" class="btn btn-primary px-5">Baru</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('rekapan') }}" class="btn btn-primary px-5">Rekapan</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary px-5" data-bs-toggle="modal"
                                    data-bs-target="#BayarModal">Bayar</button>
                            </div>
                        </div>
                    </div>
                    {{-- modal pembayaran --}}
                    <div class="modal fade" id="BayarModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
                        onclick="tampilkanDetailPesanan()">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <nav class="bg-primary">
                                    <div class="modal-header border-bottom-0 py-2">
                                        <h5 class="modal-title text-light">Pembayaran</h5>
                                        <button type="button" class="btn-close close" aria-label="Close"></button>
                                    </div>
                                </nav>
                                <form class="row g-3" method="POST" action="{{ route('pembayaran.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 fw-bold">Nama Menu</h5>
                                                <div class="mb-0 fw-bold">
                                                    <textarea class="inputan mb-3 form-control" name="menu" id="detailMenu" rows="5" placeholder="Nama Menu"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 fw-bold">Subtotal</h5>
                                                <h5 class="mb-0 fw-bold">
                                                    <input class="inputan mb-3" type="text" name="subtotal"
                                                        id="detailSubtotal" placeholder="Rp. 0">
                                                </h5>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 fw-bold">Pajak</h5>
                                                <h5 class="mb-0 fw-bold">
                                                    <input class="inputan mb-3" type="text" name="pajak"
                                                        id="detailPajak" placeholder="Rp. 0">
                                                </h5>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 fw-bold">Total :</h5>
                                                <h5 class="mb-0 fw-bold">
                                                    <input class="inputan mb-3" type="text" name="total"
                                                        id="detailTotal" placeholder="Rp. 0">
                                                </h5>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between pt-4">
                                                <h5 class="mb-0 fw-bold">Bayar :</h5>
                                                <h5 class="mb-0 fw-bold">
                                                    <input type="number" class="form-control" name="bayar"
                                                        id="inputBayar" required oninput="prosesBayar()">

                                                </h5>
                                            </div>

                                            <div class="d-flex justify-content-between pt-4">
                                                <h5 class="mb-0 fw-bold">Kembalian :</h5>
                                                <h5 class="mb-0 fw-bold">
                                                    <input class="inputan mb-3" type="text" name="kembali"
                                                        id="kembalian" placeholder="Rp. 0">
                                                </h5>
                                            </div>
                                            <hr>
                                            <div class="d-flex ">
                                                <h6 class="mb-0 fw-bold">Kasir :</h6>
                                                <h6 class="mb-0 fw-bold"> <input class="inputan-admin pb-3"
                                                        name="id_user" value="{{ Auth::user()->name }}"></h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    id="prosesBayarBtn">Bayar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End modal pembayaran --}}
                    {{-- rekapan --}}

                    {{-- end rekapan --}}
                </div>
            </div>
        </div>
    </div>
@endsection

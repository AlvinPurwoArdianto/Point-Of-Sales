<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point Of Sales</title>
    <!--favicon-->
    {{-- <link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png"> --}}
    <!-- loader-->
    <link href="assets/css/pace.min.css')}}" rel="stylesheet">
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/plugins/metismenu/mm-vertical.css') }}">
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <!--bootstrap css-->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="{{ asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"> --}}
    <!--main css-->
    <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/sass/responsive.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="bg-primary" style="overflow-x: hidden;">
    <div class="main-content">
        @include('include.frontend.header')
        @yield('content')
    </div>
    </main>
    {{-- Agar Masuk Ke tabel pesanan --}}
    <script>
        // Fungsi untuk menampilkan informasi di tabel pesanan
        function tampilkanInfo(menu, harga) {
            var jumlah = 1; // Default jumlah saat pertama kali menambahkan ke pesanan
            var total = harga * jumlah;

            // Periksa apakah menu sudah ada di dalam tabel pesanan
            var table = document.getElementById("orderStatusTable");
            var rows = table.getElementsByTagName("tr");
            var menuExists = false;

            // Mulai dari baris kedua karena baris pertama adalah header
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var menuCell = row.cells[1]; // Kolom kedua (index 1) berisi teks menu
                var existingMenu = menuCell.innerText.trim(); // Ambil teks menu dan hapus spasi di awal dan akhir

                // Jika menu sudah ada, atur flag dan keluar dari loop
                if (existingMenu.toLowerCase() === menu.toLowerCase()) {
                    menuExists = true;
                    break;
                }
            }

            // Jika menu belum ada, tambahkan ke dalam tabel
            if (!menuExists) {
                var tableBody = table.getElementsByTagName('tbody')[0];
                var newRow = tableBody.insertRow();

                // Isi baris baru dengan informasi menu, harga, jumlah, dan total
                newRow.innerHTML = '<td><input class="form-check-input ms-0" type="checkbox"></td>' +
                    '<td>' + menu + '</td>' +
                    '<td>Rp. ' + harga.toLocaleString('id-ID') + '</td>' +
                    '<td><button class="btn btn-sm btn-outline-primary" onclick="kurangJumlah(this)">-</button> ' +
                    '<span class="jumlah-item">1</span> ' +
                    '<button class="btn btn-sm btn-outline-primary" onclick="tambahJumlah(this)">+</button></td>' +
                    '<td>Rp. ' + total.toLocaleString('id-ID') + '</td>';

                // Hitung kembali subtotal, pajak, dan total akhir
                updateTotal();
            } else {
                // Jika menu sudah ada, mungkin tampilkan pesan atau tidak melakukan apa-apa
                alert('Menu sudah ada dalam pesanan!');
            }
        }

        // Fungsi untuk mengurangi jumlah item
        function kurangJumlah(button) {
            var row = button.parentNode.parentNode; // Dapatkan baris (row) yang mengandung tombol
            var jumlahElement = row.querySelector('.jumlah-item');
            var jumlah = parseInt(jumlahElement.textContent);

            if (jumlah > 1) {
                jumlah--;
                jumlahElement.textContent = jumlah;
                updateTotal();
            }
        }

        // Fungsi untuk menambah jumlah item
        function tambahJumlah(button) {
            var row = button.parentNode.parentNode; // Dapatkan baris (row) yang mengandung tombol
            var jumlahElement = row.querySelector('.jumlah-item');
            var jumlah = parseInt(jumlahElement.textContent);

            jumlah++;
            jumlahElement.textContent = jumlah;
            updateTotal();
        }

        // Fungsi untuk menghitung kembali subtotal, pajak, dan total akhir
        function updateTotal() {
            var table = document.getElementById("orderStatusTable");
            var rows = table.getElementsByTagName("tr");

            var subtotal = 0;

            // Mulai dari baris kedua karena baris pertama adalah header
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var hargaText = row.cells[2].innerText.replace('Rp. ', '').replace(/\D/g,
                    ''); // Ambil harga dan hapus karakter non-digit
                var harga = parseFloat(hargaText);

                var jumlahElement = row.querySelector('.jumlah-item');
                var jumlah = parseInt(jumlahElement.textContent);

                var total = harga * jumlah;
                row.cells[4].innerText = 'Rp. ' + total.toLocaleString('id-ID'); // Update total di dalam tabel

                subtotal += total;
            }

            var pajak = subtotal * 0.12; // Misalnya pajak 12%
            var totalAkhir = subtotal + pajak;

            // Tampilkan subtotal, pajak, dan total akhir di UI
            document.getElementById("subtotal").innerText = 'Rp. ' + subtotal.toLocaleString('id-ID');
            document.getElementById("pajak").innerText = 'Rp. ' + pajak.toLocaleString('id-ID');
            document.getElementById("totalAkhir").innerText = 'Rp. ' + totalAkhir.toLocaleString('id-ID');
        }


        // Fungsi untuk menghitung subtotal dari pesanan saat ini
        function hitungSubtotal() {
            var subtotal = 0;
            var table = document.getElementById("orderStatusTable");
            var rows = table.getElementsByTagName("tr");

            // Mulai dari baris kedua karena baris pertama adalah header
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var hargaText = row.cells[2].innerText.replace('Rp. ', '').replace(/\D/g,
                    ''); // Ambil harga dan hapus karakter non-digit
                var harga = parseFloat(hargaText);

                var jumlahElement = row.querySelector('.jumlah-item');
                var jumlah = parseInt(jumlahElement.textContent);

                subtotal += harga * jumlah;
            }

            return subtotal;
        }
    </script>
    <script>
        // Fungsi untuk menghapus item yang dipilih menggunakan checkbox
        function hapusPesanan() {
            var table = document.getElementById("orderStatusTable");
            var checkboxes = table.querySelectorAll('tbody input[type="checkbox"]:checked');

            checkboxes.forEach(function(checkbox) {
                var row = checkbox.parentNode.parentNode; // Dapatkan baris (row) yang mengandung checkbox
                row.remove(); // Hapus baris dari tabel
            });

            // Setelah menghapus, hitung ulang subtotal, pajak, dan total akhir
            var subtotal = hitungSubtotal();
            var pajak = subtotal * 0.11; // Misalnya pajak 10%
            var totalAkhir = subtotal + pajak;

            // Tampilkan kembali subtotal, pajak, dan total akhir di UI
            document.getElementById("subtotal").innerText = 'Rp. ' + subtotal.toLocaleString('id-ID');
            document.getElementById("pajak").innerText = 'Rp. ' + pajak.toLocaleString('id-ID');
            document.getElementById("totalAkhir").innerText = 'Rp. ' + totalAkhir.toLocaleString('id-ID');
        }

        // Event listener untuk checkbox di header tabel (pilih semua)
        document.getElementById("selectAllCheckbox").addEventListener("change", function() {
            var checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
    {{-- Agar Masuk Ke tabel pesanan --}}

    {{-- pencarian --}}
    <script>
        // Fungsi untuk menangani pencarian
        document.getElementById("searchInput").addEventListener("input", function() {
            var keyword = this.value.toLowerCase(); // Ambil teks pencarian dan ubah ke huruf kecil

            // Ambil semua kartu produk (menu)
            var cards = document.querySelectorAll(".product-table .card");

            // Loop melalui setiap kartu untuk memeriksa teks pencarian
            cards.forEach(function(card) {
                var menu = card.querySelector(".card-text").innerText
                    .toLowerCase(); // Ambil teks menu dan ubah ke huruf kecil

                // Jika teks pencarian cocok dengan teks menu, tampilkan kartu; jika tidak, sembunyikan
                if (menu.includes(keyword)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
    {{-- pencarian --}}

    {{-- Kategori --}}
    <script>
        function tampilkanMenu(kategori) {
            var cards = document.querySelectorAll(".product-table .card");

            cards.forEach(function(card) {
                var menuKategori = card.querySelector(".kategori").innerText.toLowerCase();

                if (menuKategori.includes(kategori.toLowerCase())) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
    {{-- Kategori --}}

    {{-- menampilkan semua kategori --}}
    <script>
        function resetKategori() {
            var cards = document.querySelectorAll(".product-table .card");
            cards.forEach(function(card) {
                card.style.display = "block"; // Tampilkan semua kartu
            });
        }
    </script>
    {{-- menampilkan semua kategori --}}

    {{-- detai modal pesanan --}}
    <script>
        function tampilkanDetailPesanan() {
            var table = document.getElementById("orderStatusTable");
            var rows = table.getElementsByTagName("tr");

            var namaMenu = ""; // String untuk menyimpan nama menu
            var subtotal = 0;

            // Mulai dari baris kedua karena baris pertama adalah header
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var menuCell = row.cells[1];
                var jumlahElement = row.querySelector('.jumlah-item');
                var jumlah = parseInt(jumlahElement.textContent.trim()); // Menggunakan trim untuk membersihkan spasi ekstra
                var hargaText = row.cells[2].innerText.replace('Rp. ', '').replace(/\D/g, '');
                var harga = parseFloat(hargaText);
                var total = harga * jumlah;
                subtotal += total;

                // Tambahkan nama menu dengan jumlah ke bawah
                namaMenu += `${menuCell.innerText} (${jumlah})\n`;
            }

            var pajak = subtotal * 0.10; // Misalnya pajak 10%
            var totalAkhir = subtotal + pajak;

            // Mengisi nilai input form pada modal tanpa format mata uang
            document.getElementById("detailMenu").value = namaMenu; // Menggunakan .value untuk input textarea
            document.getElementById("detailSubtotal").value = subtotal; // Hasil subtotal tanpa format
            document.getElementById("detailPajak").value = pajak; // Hasil pajak tanpa format
            document.getElementById("detailTotal").value = totalAkhir; // Hasil total tanpa format
        }
    </script>

    <script>
        function prosesBayar() {
            var totalAkhirText = document.getElementById("detailTotal").value.replace('Rp. ', '').replace(/\D/g, '');
            var totalAkhir = parseFloat(totalAkhirText);

            var inputBayar = document.getElementById("inputBayar").value;
            var bayar = parseFloat(inputBayar) || 0; // Default ke 0 jika input tidak valid

            var kembalian = bayar - totalAkhir;

            if (kembalian >= 0) {
                document.getElementById("kembalian").value = kembalian;
            } else {
                document.getElementById("kembalian").value = ''; // Kosongkan jika kurang
                // Optionally show an alert or message
                // alert('Jumlah uang yang dimasukkan kurang!');
            }
        }
    </script>
    {{-- detai modal pesanan --}}

    <!--bootstrap js-->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
    {{-- <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> --}}
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    {{-- <script>
        let table = new DataTable('#tabelfront');
    </script> --}}


    @yield('js')
    @stack('script')

</body>

</html>

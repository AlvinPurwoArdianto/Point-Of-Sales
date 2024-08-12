<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            {{-- <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-img" alt=""> --}}
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Admin - POS</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                {{-- </li>
            <li>
                <a href="{{ route('kasir.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i>
                    </div>
                    <div class="menu-title">Daftar Kasir</div>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('user.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">face_5</i>
                    </div>
                    <div class="menu-title">Daftar Kasir</div>
                </a>
            </li>
            <li class="menu-label">Pages</li>

            <li>
                <a href="{{ route('kategori.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">menu</i>
                    </div>
                    <div class="menu-title">Kategori</div>
                </a>
            </li>
            <li>
                <a href="{{ route('menu.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">join_right</i>
                    </div>
                    <div class="menu-title">Menu</div>
                </a>
            </li>
            <li>
                <a href="{{ route('pembayaran.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i>
                    </div>
                    <div class="menu-title">Rekapan Pembayaran</div>
                </a>
            </li>
            <li>
                <a href="{{ route('kasir') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">apps</i>
                    </div>
                    <div class="menu-title">Tampilan Kasir</div>
                </a>
            </li>

        </ul>
        <!--end navigation-->
    </div>
</aside>

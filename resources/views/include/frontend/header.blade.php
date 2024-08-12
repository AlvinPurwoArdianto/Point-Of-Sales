<div class="card bg-primary" style="margin-bottom: 0.4rem">
    <div class="card-body">
        <div class="d-flex align-items-lg-center justify-content-between gap-3">
            <div class="flex-grow-1" style="margin-left: 20px">
                <h1 class="fw-bold pl text-light">KASIR</h1>
            </div>
            <h5 class="user-name mb-0 fw-bold text-light">{{ Auth::user()->name }}</h5>
            <li class="nav-item dropdown" style="list-style:none;">
                <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="https://placehold.co/110x110/png" class="rounded-circle p-1" width="40" height="40"
                        alt="">
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('login') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons-outlined">power_settings_new</i>Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
    </div>
</div>

{{-- Top Navbar --}}
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo/Brand -->
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="." class="d-flex align-items-center">
                <x-icon name="building-skyscraper" size="32"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper" />
                <h3 class="h2 ms-2 mb-0">KantorKu</h3>
            </a>
        </div>

        <!-- Right side items -->
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <!-- Theme Toggle -->
                <div class="nav-item">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <x-icon name="moon" />
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <x-icon name="sun" />
                    </a>
                </div>

                <!-- Notifications Dropdown -->
                <div class="nav-item dropdown d-none d-md-flex">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications" data-bs-auto-close="outside">
                        <x-icon name="bell" />
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title">Notifikasi</h3>
                                <div class="btn-close ms-auto" data-bs-dismiss="dropdown"></div>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="status-dot status-dot-animated bg-red d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Contoh Notifikasi</a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                Belum ada notifikasi baru
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Apps Menu Dropdown -->
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show app menu" data-bs-auto-close="outside">
                        <x-icon name="apps" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Menu Aplikasi</div>
                            </div>
                            <div class="card-body p-2">
                                <div class="text-center text-secondary py-3">
                                    <p>Aplikasi akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Profile Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    @if (Auth::user()->avatar)
                        <span class="avatar avatar-sm" style="background-image: url({{ Auth::user()->avatar }})"></span>
                    @else
                        <span class="avatar avatar-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-secondary">{{ Auth::user()->role->nama_role }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Pengaturan</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="confirmLogout()">Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Main Navigation --}}
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">
                        <!-- Main Menu -->
                        <ul class="navbar-nav">
                            @if (request()->routeIs('panel.*'))
                                {{-- Panel Dashboard & Admin Menu --}}
                                <li class="nav-item {{ request()->routeIs('panel.dashboard') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('panel.dashboard') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon name="dashboard" />
                                        </span>
                                        <span class="nav-link-title">Dashboard</span>
                                    </a>
                                </li>

                                {{-- Menu Admin berdasarkan role dan permission --}}
                                <x-navbar.admin-menu />
                            @else
                                {{-- Client Navigation - Simple inline elements --}}
                                <li class="nav-item {{ request()->routeIs('client') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('client') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon name="home" />
                                        </span>
                                        <span class="nav-link-title"> Beranda </span>
                                    </a>
                                </li>

                                <li class="nav-item {{ request()->routeIs('client.aplikasi*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('client.aplikasi') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon name="apps" />
                                        </span>
                                        <span class="nav-link-title"> Layanan Aplikasi </span>
                                    </a>
                                </li>
                            @endif

                            <!-- Help Dropdown - Simple inline dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon name="help" />
                                    </span>
                                    <span class="nav-link-title"> Bantuan </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="./accordion.html">Pertanyaan Umum</a>
                                            <a class="dropdown-item" href="./accordion.html">User Guide</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons - Simple inline buttons -->
                    <div class="col col-md-auto">
                        <ul class="navbar-nav">
                            @if (request()->routeIs('panel.*'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon name="home-share" />
                                        </span>
                                        <span class="nav-link-title"><b> Beranda</b></span>
                                    </a>
                                </li>
                            @else
                                @if (auth()->user()->hasNonDefaultPermissions())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('panel.dashboard') }}">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <x-icon name="category" />
                                            </span>
                                            <span class="nav-link-title"> <b>Panel</b> </span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSettings">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon name="settings" />
                                    </span>
                                    <span class="nav-link-title"> Pengaturan </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- JavaScript untuk logout confirmation --}}
<x-navbar.logout-script />

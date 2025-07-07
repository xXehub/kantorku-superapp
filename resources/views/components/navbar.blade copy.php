        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="fas fa-city text-primary me-2"></i>
                    <span class="fw-bold">KantorKu SuperApp</span>
                    <small class="text-muted ms-2 d-none d-md-inline">Surabaya</small>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('client*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('client') }}">
                                    <i class="fas fa-home"></i>
                                    <span class="d-md-inline">Beranda</span>
                                </a>
                            </li>

                          
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('panel.*') ? 'active fw-bold' : '' }}"
                                        href="{{ route('panel.dashboard') }}">
                                        <i class="fas fa-cogs"></i>
                                        <span class="d-md-inline">Panel</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i> {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <!-- Notifications (if any) -->
                            <li class="nav-item dropdown d-none d-md-block">
                                <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge bg-danger badge-notification badge-pill">3</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <h6 class="dropdown-header">Notifikasi</h6>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-info-circle text-primary"></i>
                                        <span class="ms-2">Update sistem tersedia</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-plus text-success"></i>
                                        <span class="ms-2">User baru bergabung</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        <span class="ms-2">Maintenance terjadwal</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-center" href="#">Lihat semua notifikasi</a>
                                </div>
                            </li>

                            <!-- User Menu -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <div class="avatar avatar-sm me-2">
                                        <span class="avatar-title bg-primary rounded-circle">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                                        <div class="small text-muted">
                                            @if (Auth::user()->isSuperAdmin())
                                                <span class="badge bg-danger">Super Admin</span>
                                            @elseif(Auth::user()->isAdmin())
                                                <span class="badge bg-warning">Admin</span>
                                            @else
                                                <span class="badge bg-info">User</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-header">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                    </div>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('client') }}">
                                        <i class="fas fa-home text-primary"></i>
                                        <span class="ms-2">Beranda</span>
                                    </a>

                                    @if (auth()->user()->hasNonDefaultPermissions())
                                        <a class="dropdown-item" href="{{ route('panel.dashboard') }}">
                                            <i class="fas fa-cogs text-warning"></i>
                                            <span class="ms-2">Panel Manajemen</span>
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="#" onclick="showProfileModal()">
                                        <i class="fas fa-user text-info"></i>
                                        <span class="ms-2">Profil Saya</span>
                                    </a>

                                    <a class="dropdown-item" href="#" onclick="showSettingsModal()">
                                        <i class="fas fa-cog text-secondary"></i>
                                        <span class="ms-2">Pengaturan</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span class="ms-2">{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
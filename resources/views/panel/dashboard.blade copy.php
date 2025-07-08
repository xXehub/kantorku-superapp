<x-app>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="mb-2">
                                    <i class="fas fa-cogs"></i> Panel Manajemen
                                </h3>
                                <p class="mb-0">Dashboard terpadu untuk mengelola sistem KantorKu SuperApp</p>
                                <small class="opacity-75">
                                    <i class="fas fa-user"></i>
                                    {{ auth()->user()->role ? auth()->user()->role->nama_role : 'User' }} -
                                    {{ auth()->user()->instansi ? auth()->user()->instansi->nama_instansi : 'No Instansi' }}
                                </small>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('client') }}" class="btn btn-light">
                                    <i class="fas fa-home"></i> Kembali ke Client Area
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            @if (auth()->user()->is_superadmin)
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <h4>{{ $stats['total_users'] ?? 0 }}</h4>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                            <h4>{{ $stats['total_apps'] ?? 0 }}</h4>
                            <p>Total Aplikasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-2x mb-2"></i>
                            <h4>{{ $stats['total_instansi'] ?? 0 }}</h4>
                            <p>Total Instansi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-user-tag fa-2x mb-2"></i>
                            <h4>{{ $stats['total_roles'] ?? 0 }}</h4>
                            <p>Total Roles</p>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->role && auth()->user()->role->nama_role === 'Administrator')
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <h4>{{ $stats['instansi_users'] ?? 0 }}</h4>
                            <p>Users Instansi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                            <h4>{{ $stats['instansi_apps'] ?? 0 }}</h4>
                            <p>Apps Instansi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h4>{{ $stats['active_instansi_apps'] ?? 0 }}</h4>
                            <p>Apps Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x mb-2"></i>
                            <h4>{{ $stats['pending_instansi_users'] ?? 0 }}</h4>
                            <p>Users Pending</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                            <h4>{{ $stats['my_apps'] ?? 0 }}</h4>
                            <p>Aplikasi Dikelola</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-2x mb-2"></i>
                            <h4>{{ $stats['my_instansi'] ?? 0 }}</h4>
                            <p>Instansi Terkait</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Management Sections -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-tools"></i> Modul Manajemen
                        </h5>
                    </div>
                    <div class="card-body">
                        @if (!empty($availableSections))
                            <div class="row">
                                @foreach ($availableSections as $key => $section)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-primary">
                                            <div class="card-body text-center">
                                                <i class="{{ $section['icon'] }} fa-3x text-primary mb-3"></i>
                                                <h5>{{ $section['title'] }}</h5>
                                                <p class="text-muted">{{ $section['description'] }}</p>
                                                <a href="{{ route($section['route']) }}" class="btn btn-primary">
                                                    <i class="fas fa-arrow-right"></i> Kelola
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <h5>Tidak Ada Modul Tersedia</h5>
                                <p class="text-muted">Anda tidak memiliki akses ke modul manajemen apapun.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities (if has data) -->
        @if (!empty($recentData))
            <div class="row mt-4">
                @if (isset($recentData['recent_users']) && $recentData['recent_users']->count() > 0)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="fas fa-users text-primary"></i> User Terbaru
                                </h6>
                            </div>
                            <div class="card-body">
                                @foreach ($recentData['recent_users'] as $user)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            <br><small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if (!$loop->last)
                                        <hr class="my-2">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($recentData['recent_apps']) && $recentData['recent_apps']->count() > 0)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="fas fa-mobile-alt text-success"></i> Aplikasi Terbaru
                                </h6>
                            </div>
                            <div class="card-body">
                                @foreach ($recentData['recent_apps'] as $app)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <strong>{{ $app->nama_app }}</strong>
                                            <br><small
                                                class="text-muted">{{ $app->instansi->nama_instansi ?? 'No Instansi' }}</small>
                                        </div>
                                        <small class="text-muted">{{ $app->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if (!$loop->last)
                                        <hr class="my-2">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app>>

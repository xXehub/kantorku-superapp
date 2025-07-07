<x-app title="Client Area - KantorKu SuperApp">
    <div class="container-fluid">
        <!-- Hero Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-2">
                                    <i class="fas fa-home"></i> Selamat Datang, {{ auth()->user()->name }}!
                                </h2>
                                <p class="mb-0">
                                    Sistem Informasi Terintegrasi Pemerintah Kota Surabaya
                                </p>
                                @if (auth()->user()->instansi)
                                    <small class="opacity-75">
                                        <i class="fas fa-building"></i> {{ auth()->user()->instansi->nama_instansi }}
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-4 text-end">
                                @if ($hasPanelAccess)
                                    <a href="{{ route('panel.dashboard') }}" class="btn btn-light btn-lg">
                                        <i class="fas fa-cogs"></i> Panel Manajemen
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-mobile-alt fa-2x text-primary mb-2"></i>
                        <h4>{{ $apps->count() }}</h4>
                        <p class="text-muted">Aplikasi Tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-building fa-2x text-success mb-2"></i>
                        <h4>{{ $instansi->count() }}</h4>
                        <p class="text-muted">Instansi Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-user-circle fa-2x text-info mb-2"></i>
                        <h4>{{ auth()->user()->role ? auth()->user()->role->nama_role : 'User' }}</h4>
                        <p class="text-muted">Role Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar fa-2x text-warning mb-2"></i>
                        <h4>{{ auth()->user()->created_at->format('M Y') }}</h4>
                        <p class="text-muted">Bergabung Sejak</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Aplikasi Tersedia -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-mobile-alt text-primary"></i> Aplikasi Tersedia
                        </h5>
                        <span class="badge bg-primary">{{ $apps->count() }} aplikasi</span>
                    </div>
                    <div class="card-body">
                        @if ($apps->count() > 0)
                            <div class="row">
                                @foreach ($apps as $app)
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100 border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 50px; height: 50px;">
                                                            <i class="fas fa-cube"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">{{ $app->nama_app }}</h6>
                                                        <p class="text-muted small mb-2">
                                                            {{ Str::limit($app->deskripsi_app, 80) }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span
                                                                class="badge bg-success">{{ $app->instansi->nama_instansi }}</span>
                                                            <div class="d-flex gap-2">
                                                                @if ($app->url_app)
                                                                    <a href="{{ $app->url_app }}" target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-external-link-alt"></i> Buka
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted small">Coming Soon</span>
                                                                @endif
                                                                @if (
                                                                    $hasPanelAccess &&
                                                                        (auth()->user()->is_superadmin ||
                                                                            auth()->user()->app_id == $app->id ||
                                                                            auth()->user()->instansi_id == $app->instansi_id))
                                                                    <a href="{{ route('panel.apps.edit', $app->id) }}"
                                                                        class="btn btn-sm btn-outline-warning">
                                                                        <i class="fas fa-cog"></i> Setting
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-mobile-alt fa-3x text-muted mb-3"></i>
                                <h5>Belum Ada Aplikasi</h5>
                                <p class="text-muted">Aplikasi akan ditampilkan di sini setelah dikonfigurasi.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Profil Saya -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-user text-info"></i> Profil Saya
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>{{ auth()->user()->username }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>
                                    @if (auth()->user()->role)
                                        <span class="badge bg-primary">{{ auth()->user()->role->nama_role }}</span>
                                    @else
                                        <span class="text-muted">Belum ada role</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($userInstansi)
                                <tr>
                                    <td><strong>Instansi:</strong></td>
                                    <td>{{ $userInstansi->nama_instansi }}</td>
                                </tr>
                            @endif
                            @if ($managedApp)
                                <tr>
                                    <td><strong>Mengelola:</strong></td>
                                    <td>{{ $managedApp->nama_app }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Instansi Aktif -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-building text-success"></i> Instansi Aktif
                        </h6>
                        <span class="badge bg-success">{{ $instansi->count() }} instansi</span>
                    </div>
                    <div class="card-body">
                        @if ($instansi->count() > 0)
                            <div class="row">
                                @foreach ($instansi as $inst)
                                    <div class="col-12 mb-3">
                                        <div class="card border h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">{{ $inst->nama_instansi }}</h6>
                                                        <p class="text-muted small mb-2">{{ $inst->apps_count }}
                                                            aplikasi tersedia</p>
                                                        <span class="badge bg-success">Aktif</span>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('client.instansi.show', $inst->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i> Selengkapnya
                                                        </a>
                                                        @if ($hasPanelAccess && (auth()->user()->is_superadmin || auth()->user()->instansi_id == $inst->id))
                                                            <a href="{{ route('panel.instansi.edit', $inst->id) }}"
                                                                class="btn btn-sm btn-outline-warning">
                                                                <i class="fas fa-cog"></i> Setting
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center">Belum ada instansi terdaftar.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>

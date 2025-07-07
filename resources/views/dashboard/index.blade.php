@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-tachometer-alt text-primary"></i>
                        Dashboard - Selamat datang, {{ Auth::user()->name }}!
                        @if(Auth::user()->is_superadmin)
                            <span class="badge bg-danger ms-2">Super Administrator</span>
                        @elseif(Auth::user()->role)
                            <span class="badge bg-primary ms-2">{{ Auth::user()->role->nama_role }}</span>
                        @else
                            <span class="badge bg-secondary ms-2">Belum ada role</span>
                        @endif
                    </h4>
                    <p class="mb-0 text-muted">
                        @if(Auth::user()->instansi)
                            {{ Auth::user()->instansi->nama_instansi }}
                        @elseif(Auth::user()->is_superadmin)
                            Semua Instansi Pemerintah Kota Surabaya
                        @else
                            Belum ditugaskan ke instansi
                        @endif
                    </p>
                </div>

                <div class="card-body">
                    <!-- Summary Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-cube fa-2x mb-2"></i>
                                    <h3>{{ $stats['total_apps'] }}</h3>
                                    <p class="mb-0">Total Aplikasi</p>
                                    <small class="opacity-75">{{ $stats['total_active_apps'] }} Aktif</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-building fa-2x mb-2"></i>
                                    <h3>{{ $stats['total_instansi'] }}</h3>
                                    <p class="mb-0">Total Instansi</p>
                                    <small class="opacity-75">{{ $stats['total_active_instansi'] }} Aktif</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h3>{{ $stats['total_users'] }}</h3>
                                    <p class="mb-0">Total Pengguna</p>
                                    <small class="opacity-75">Semua Role</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-tag fa-2x mb-2"></i>
                                    <h3>{{ $stats['total_roles'] }}</h3>
                                    <p class="mb-0">Total Role</p>
                                    <small class="opacity-75">Sistem Role</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Instansi dengan Aplikasi -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-building text-success"></i> 
                                        Daftar Instansi & Aplikasi
                                    </h5>
                                    @if(Auth::user()->is_superadmin)
                                    <div class="btn-group">
                                        <a href="{{ route('master.instansi.create') }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i> Tambah Instansi
                                        </a>
                                        <a href="{{ route('master.master-app.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Tambah Aplikasi
                                        </a>
                                    </div>
                                    @elseif($stats['can_manage'])
                                    <a href="{{ route('master.master-app.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Aplikasi
                                    </a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if($userInstansi->count() > 0)
                                        <div class="row">
                                            @foreach($userInstansi as $instansi)
                                            <div class="col-md-12 mb-4">
                                                <div class="card border-success">
                                                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-0">
                                                                <span class="badge bg-light text-success me-2">{{ $instansi->kode_instansi }}</span>
                                                                {{ $instansi->nama_instansi }}
                                                            </h6>
                                                            @if($instansi->deskripsi_instansi)
                                                                <small class="opacity-75">{{ Str::limit($instansi->deskripsi_instansi, 100) }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="btn-group">
                                                            <a href="{{ route('master.instansi.show', $instansi) }}" class="btn btn-sm btn-light text-success" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            @if(Auth::user()->is_superadmin)
                                                                <a href="{{ route('master.instansi.edit', $instansi) }}" class="btn btn-sm btn-warning" title="Edit Instansi">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form action="{{ route('master.instansi.destroy', $instansi) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus instansi {{ $instansi->nama_instansi }}?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Instansi">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                @if($instansi->alamat_instansi)
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                                        {{ $instansi->alamat_instansi }}
                                                                    </small>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if($instansi->telepon_instansi)
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-phone me-1"></i>
                                                                        {{ $instansi->telepon_instansi }}
                                                                    </small>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if($instansi->email_instansi)
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-envelope me-1"></i>
                                                                        {{ $instansi->email_instansi }}
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Aplikasi dalam Instansi -->
                                                        <h6 class="text-primary mb-3">
                                                            <i class="fas fa-cube me-1"></i>
                                                            Aplikasi ({{ $instansi->masterApps->count() }})
                                                        </h6>
                                                        @if($instansi->masterApps->count() > 0)
                                                            <div class="row">
                                                                @foreach($instansi->masterApps as $app)
                                                                <div class="col-md-6 col-lg-4 mb-3">
                                                                    <div class="card border-primary h-100">
                                                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2">
                                                                            <span class="badge bg-light text-primary">{{ $app->kode_app }}</span>
                                                                            @if($app->is_active)
                                                                                <span class="badge bg-success">Aktif</span>
                                                                            @else
                                                                                <span class="badge bg-secondary">Non-aktif</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-body p-3">
                                                                            <h6 class="card-title mb-2">{{ $app->nama_app }}</h6>
                                                                            <p class="card-text text-muted small mb-2">
                                                                                {{ Str::limit($app->deskripsi_app ?? 'Tidak ada deskripsi', 80) }}
                                                                            </p>
                                                                            @if($app->url_app)
                                                                                <p class="card-text">
                                                                                    <a href="{{ $app->url_app }}" target="_blank" class="text-decoration-none small">
                                                                                        <i class="fas fa-external-link-alt me-1"></i>
                                                                                        Buka Aplikasi
                                                                                    </a>
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-footer bg-transparent p-2">
                                                                            <div class="btn-group w-100" role="group">
                                                                                <a href="{{ route('master.master-app.show', $app) }}" class="btn btn-sm btn-info">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </a>
                                                                                
                                                                                @php
                                                                                    $user = Auth::user();
                                                                                    $canEditApp = false;
                                                                                    
                                                                                    if ($user->is_superadmin) {
                                                                                        $canEditApp = true;
                                                                                    } elseif ($user->role && $user->role->nama_role === 'Administrator') {
                                                                                        $canEditApp = ($user->app_id == $app->id) || ($user->instansi_id == $app->instansi_id);
                                                                                    }
                                                                                @endphp
                                                                                
                                                                                @if($canEditApp)
                                                                                    <a href="{{ route('master.master-app.edit', $app) }}" class="btn btn-sm btn-warning">
                                                                                        <i class="fas fa-edit"></i>
                                                                                    </a>
                                                                                    
                                                                                    @if($user->is_superadmin)
                                                                                        <form action="{{ route('master.master-app.destroy', $app) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus aplikasi {{ $app->nama_app }}?')">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                                                <i class="fas fa-trash"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="text-center py-3">
                                                                <i class="fas fa-cube fa-2x text-muted mb-2"></i>
                                                                <p class="text-muted mb-2">Belum ada aplikasi aktif di instansi ini</p>
                                                                @if($stats['can_manage'])
                                                                    <a href="{{ route('master.master-app.create') }}" class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-plus"></i> Tambah Aplikasi
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada instansi aktif</h5>
                                            <p class="text-muted">Sistem akan menampilkan semua instansi aktif di sini</p>
                                            @if(Auth::user()->is_superadmin)
                                                <a href="{{ route('master.instansi.create') }}" class="btn btn-success">
                                                    <i class="fas fa-plus"></i> Tambah Instansi Pertama
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Panel -->
                    @if(Auth::user()->is_superadmin || $stats['can_manage'])
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-tools text-warning"></i> Panel Admin</h5>
                                </div>
                                <div class="card-body">
                                    @if(Auth::user()->is_superadmin)
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a href="{{ route('master.dashboard') }}" class="btn btn-danger w-100">
                                                <i class="fas fa-crown"></i> Master Panel Dashboard
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('master.users.index') }}" class="btn btn-outline-primary w-100 mb-2">
                                                <i class="fas fa-users"></i> Kelola Pengguna
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('master.roles.index') }}" class="btn btn-outline-success w-100 mb-2">
                                                <i class="fas fa-user-tag"></i> Kelola Role
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('master.master-app.index') }}" class="btn btn-outline-warning w-100 mb-2">
                                                <i class="fas fa-cube"></i> Kelola Aplikasi
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('master.instansi.index') }}" class="btn btn-outline-info w-100 mb-2">
                                                <i class="fas fa-building"></i> Kelola Instansi
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <!-- Admin Panel for App Managers -->
                                    <div class="row">
                                        @if($stats['can_edit_apps'] && Auth::user()->app_id)
                                        <div class="col-md-12 mb-3">
                                            <div class="alert alert-info">
                                                <h6><i class="fas fa-info-circle me-2"></i>Panel Admin Aplikasi</h6>
                                                <p class="mb-0">Anda dapat mengelola aplikasi yang ditugaskan di instansi Anda</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('master.master-app.index') }}" class="btn btn-outline-warning w-100 mb-2">
                                                <i class="fas fa-cube"></i> Kelola Aplikasi
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('master.instansi.index') }}" class="btn btn-outline-info w-100 mb-2">
                                                <i class="fas fa-building"></i> Lihat Instansi
                                            </a>
                                        </div>
                                        @else
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Akses Admin Terbatas</h6>
                                                <p class="mb-0">Anda memiliki role Administrator namun belum ditugaskan untuk mengelola aplikasi tertentu. Silakan hubungi Superadmin untuk assignment.</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Card interactions
    $('.card').hover(
        function() { $(this).addClass('shadow-lg'); },
        function() { $(this).removeClass('shadow-lg'); }
    );
});
</script>
@endpush
@endsection

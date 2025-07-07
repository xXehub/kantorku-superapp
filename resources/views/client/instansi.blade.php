@extends('layouts.app')

@section('title', $instansi->nama_instansi . ' - KantorKu SuperApp')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb text-white mb-2">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client') }}" class="text-white text-decoration-none">
                                            <i class="fas fa-home"></i> Beranda
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $instansi->nama_instansi }}</li>
                                </ol>
                            </nav>
                            <h2 class="mb-2">
                                <i class="fas fa-building"></i> {{ $instansi->nama_instansi }}
                            </h2>
                            <p class="mb-0 opacity-90">
                                Aplikasi dan layanan digital terintegrasi
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($hasManagementAccess)
                                <a href="{{ route('panel.instansi.edit', $instansi->id) }}" class="btn btn-light">
                                    <i class="fas fa-cog"></i> Kelola Instansi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <i class="fas fa-mobile-alt fa-2x text-primary mb-2"></i>
                    <h4 class="text-primary">{{ $instansi->apps->count() }}</h4>
                    <p class="text-muted mb-0">Total Aplikasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h4 class="text-success">{{ $instansi->apps->where('is_active', true)->count() }}</h4>
                    <p class="text-muted mb-0">Aplikasi Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <i class="fas fa-globe fa-2x text-info mb-2"></i>
                    <h4 class="text-info">{{ $instansi->apps->whereNotNull('url_app')->count() }}</h4>
                    <p class="text-muted mb-0">Dapat Diakses</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h4 class="text-warning">{{ $instansi->apps->whereNull('url_app')->count() }}</h4>
                    <p class="text-muted mb-0">Coming Soon</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Apps Grid -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-th-large text-primary"></i> Semua Aplikasi
                    </h5>
                    @if($hasManagementAccess)
                        <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Aplikasi
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($instansi->apps->count() > 0)
                        <div class="row">
                            @foreach($instansi->apps as $app)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100 border {{ $app->is_active ? 'border-success' : 'border-secondary' }}">
                                        <div class="card-body d-flex flex-column">
                                            <div class="text-center mb-3">
                                                <div class="bg-{{ $app->is_active ? 'primary' : 'secondary' }} text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-cube fa-2x"></i>
                                                </div>
                                            </div>
                                            
                                            <h6 class="text-center mb-2">{{ $app->nama_app }}</h6>
                                            <p class="text-muted small text-center mb-3 flex-grow-1">
                                                {{ $app->deskripsi_app ?: 'Deskripsi belum tersedia' }}
                                            </p>
                                            
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-code"></i> {{ $app->kode_app }}
                                                    </small>
                                                    <span class="badge bg-{{ $app->is_active ? 'success' : 'secondary' }}">
                                                        {{ $app->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </div>
                                                
                                                <div class="d-grid gap-2">
                                                    @if($app->url_app && $app->is_active)
                                                        <a href="{{ $app->url_app }}" target="_blank" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-external-link-alt"></i> Buka Aplikasi
                                                        </a>
                                                    @else
                                                        <button class="btn btn-outline-secondary btn-sm" disabled>
                                                            <i class="fas fa-clock"></i> Coming Soon
                                                        </button>
                                                    @endif
                                                    
                                                    @if($hasManagementAccess || (auth()->user()->app_id == $app->id))
                                                        <a href="{{ route('panel.apps.edit', $app->id) }}" class="btn btn-outline-warning btn-sm">
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
                        <div class="text-center py-5">
                            <i class="fas fa-mobile-alt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Aplikasi</h5>
                            <p class="text-muted">Instansi ini belum memiliki aplikasi yang terdaftar.</p>
                            @if($hasManagementAccess)
                                <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Aplikasi Pertama
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Instansi Info -->
    @if($instansi->alamat || $instansi->telepon || $instansi->email)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle text-info"></i> Informasi Instansi
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($instansi->alamat)
                                <div class="col-md-4 mb-3">
                                    <strong><i class="fas fa-map-marker-alt text-danger"></i> Alamat:</strong>
                                    <p class="mb-0">{{ $instansi->alamat }}</p>
                                </div>
                            @endif
                            @if($instansi->telepon)
                                <div class="col-md-4 mb-3">
                                    <strong><i class="fas fa-phone text-success"></i> Telepon:</strong>
                                    <p class="mb-0">{{ $instansi->telepon }}</p>
                                </div>
                            @endif
                            @if($instansi->email)
                                <div class="col-md-4 mb-3">
                                    <strong><i class="fas fa-envelope text-primary"></i> Email:</strong>
                                    <p class="mb-0">{{ $instansi->email }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

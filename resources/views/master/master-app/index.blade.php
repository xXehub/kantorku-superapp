@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-cube text-warning"></i> 
                        Master Aplikasi Pemerintah Kota Surabaya
                    </h4>
                    @if(auth()->user()->is_superadmin || (auth()->user()->role && auth()->user()->role->nama_role === 'Administrator'))
                    <a href="{{ route('master.master-app.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Aplikasi
                    </a>
                    @endif
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($apps->count() > 0)
                        <div class="row">
                            @foreach($apps as $app)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <span class="badge bg-warning text-dark">{{ $app->kode_app }}</span>
                                        @if($app->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Non-aktif</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $app->nama_app }}</h5>
                                        
                                        @if($app->instansi)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-building"></i> 
                                                    <span class="badge bg-info">{{ $app->instansi->kode_instansi }}</span>
                                                    {{ $app->instansi->nama_instansi }}
                                                </small>
                                            </p>
                                        @endif

                                        <p class="card-text">{{ Str::limit($app->deskripsi_app ?? 'Tidak ada deskripsi', 100) }}</p>
                                        
                                        @if($app->url_app)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-link"></i> 
                                                    <a href="{{ $app->url_app }}" target="_blank" class="text-decoration-none">
                                                        Buka Aplikasi <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </small>
                                            </p>
                                        @endif

                                        @if($app->creator)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-user"></i> Dibuat oleh: {{ $app->creator->name }}
                                                    @if($app->creator->is_superadmin)
                                                        <span class="badge bg-danger">Super Admin</span>
                                                    @endif
                                                </small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100" role="group">
                                            <!-- View button - available to all users -->
                                            <a href="{{ route('master.master-app.show', $app) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat Detail
                                            </a>
                                            
                                            @php
                                                $user = auth()->user();
                                                $canEdit = false;
                                                
                                                // Check edit access based on user role and assignment
                                                if ($user->is_superadmin) {
                                                    $canEdit = true;
                                                } elseif ($user->role && $user->role->nama_role === 'Administrator') {
                                                    // Admin can edit if they're assigned to this app OR if app belongs to their instansi
                                                    $canEdit = ($user->app_id == $app->id) || ($user->instansi_id == $app->instansi_id);
                                                }
                                            @endphp
                                            
                                            @if($canEdit)
                                                <!-- Edit button for users with edit access -->
                                                <a href="{{ route('master.master-app.edit', $app) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                
                                                @if($user->is_superadmin)
                                                <!-- Delete button only for superadmin -->
                                                <form action="{{ route('master.master-app.destroy', $app) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus aplikasi {{ $app->nama_app }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
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
                        <div class="text-center py-5">
                            <i class="fas fa-cube fa-3x text-muted mb-3"></i>
                            <h5>Belum ada aplikasi aktif yang terdaftar</h5>
                            <p class="text-muted">Sistem akan menampilkan aplikasi aktif dari semua instansi di sini</p>
                            @if(auth()->user()->is_superadmin || (auth()->user()->role && auth()->user()->role->nama_role === 'Administrator'))
                            <a href="{{ route('master.master-app.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Aplikasi Pertama
                            </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

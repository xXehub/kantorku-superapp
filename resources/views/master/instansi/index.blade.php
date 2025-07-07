@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-building text-info"></i> 
                        Daftar Instansi Pemerintah Kota Surabaya
                    </h4>
                    @if(auth()->user()->is_superadmin)
                    <a href="{{ route('master.instansi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Instansi
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

                    @if($instansi->count() > 0)
                        <div class="row">
                            @foreach($instansi as $inst)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $inst->kode_instansi }}</span>
                                        @if($inst->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Non-aktif</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $inst->nama_instansi }}</h5>
                                        
                                        @if($inst->deskripsi_instansi)
                                            <p class="card-text">{{ Str::limit($inst->deskripsi_instansi, 100) }}</p>
                                        @endif

                                        @if($inst->alamat_instansi)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt"></i> {{ Str::limit($inst->alamat_instansi, 80) }}
                                                </small>
                                            </p>
                                        @endif

                                        @if($inst->telepon_instansi)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-phone"></i> {{ $inst->telepon_instansi }}
                                                </small>
                                            </p>
                                        @endif

                                        @if($inst->email_instansi)
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-envelope"></i> 
                                                    <a href="mailto:{{ $inst->email_instansi }}">{{ $inst->email_instansi }}</a>
                                                </small>
                                            </p>
                                        @endif

                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-cube"></i> 
                                                <span class="badge bg-info">{{ $inst->master_apps_count ?? 0 }} Aplikasi</span>
                                                <span class="badge bg-secondary">{{ $inst->users_count ?? 0 }} Pengguna</span>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100" role="group">
                                            <!-- View button - available to all users -->
                                            <a href="{{ route('master.instansi.show', $inst) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat Detail
                                            </a>
                                            
                                            @if(auth()->user()->is_superadmin)
                                                <!-- Edit button only for superadmin -->
                                                <a href="{{ route('master.instansi.edit', $inst) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                
                                                <!-- Delete button only for superadmin -->
                                                <form action="{{ route('master.instansi.destroy', $inst) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus instansi {{ $inst->nama_instansi }}? Data ini akan menghapus semua aplikasi terkait.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                            <h5>Belum ada instansi aktif yang terdaftar</h5>
                            <p class="text-muted">Sistem akan menampilkan instansi aktif Pemerintah Kota Surabaya di sini</p>
                            @if(auth()->user()->is_superadmin)
                            <a href="{{ route('master.instansi.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Instansi Pertama
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

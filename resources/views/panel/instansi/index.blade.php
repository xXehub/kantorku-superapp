@extends('layouts.app')

@section('title', 'Manajemen Instansi - Panel')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('panel.dashboard') }}">
                                            <i class="fas fa-cogs"></i> Panel
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Instansi</li>
                                </ol>
                            </nav>
                            <h4 class="mb-0">
                                <i class="fas fa-building text-primary"></i> Manajemen Instansi
                            </h4>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('panel.instansi.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Instansi
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
            <div class="card border-primary">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-2x text-primary mb-2"></i>
                    <h4 class="text-primary">{{ $instansi->total() }}</h4>
                    <p class="text-muted mb-0">Total Instansi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h4 class="text-success">{{ $instansi->where('is_active', 1)->count() }}</h4>
                    <p class="text-muted mb-0">Instansi Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt fa-2x text-info mb-2"></i>
                    <h4 class="text-info">{{ $instansi->sum(function($inst) { return $inst->apps->count(); }) }}</h4>
                    <p class="text-muted mb-0">Total Aplikasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-warning mb-2"></i>
                    <h4 class="text-warning">{{ $instansi->sum(function($inst) { return $inst->users->count(); }) }}</h4>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Instansi List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Daftar Instansi ({{ $instansi->total() }})
                    </h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success">{{ $instansi->where('is_active', 1)->count() }} Aktif</span>
                        <span class="badge bg-secondary">{{ $instansi->where('is_active', 0)->count() }} Nonaktif</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($instansi->count() > 0)
                        <div class="row">
                            @foreach($instansi as $inst)
                                <div class="col-lg-6 col-xl-4 mb-4">
                                    <div class="card h-100 border {{ $inst->is_active ? 'border-success' : 'border-secondary' }}">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $inst->nama_instansi }}</h6>
                                                    <p class="text-muted small mb-2">
                                                        <i class="fas fa-code"></i> {{ $inst->kode_instansi }}
                                                    </p>
                                                </div>
                                                <span class="badge bg-{{ $inst->is_active ? 'success' : 'secondary' }}">
                                                    {{ $inst->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </div>
                                            
                                            @if($inst->deskripsi_instansi)
                                                <p class="text-muted small flex-grow-1">
                                                    {{ Str::limit($inst->deskripsi_instansi, 100) }}
                                                </p>
                                            @endif
                                            
                                            <!-- Stats -->
                                            <div class="row text-center mb-3">
                                                <div class="col-4">
                                                    <div class="border-end">
                                                        <h6 class="text-primary mb-0">{{ $inst->apps->count() }}</h6>
                                                        <small class="text-muted">Apps</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border-end">
                                                        <h6 class="text-success mb-0">{{ $inst->apps->where('is_active', true)->count() }}</h6>
                                                        <small class="text-muted">Aktif</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="text-info mb-0">{{ $inst->users->count() }}</h6>
                                                    <small class="text-muted">Users</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Contact Info -->
                                            @if($inst->alamat_instansi || $inst->telepon_instansi || $inst->email_instansi)
                                                <div class="mb-3">
                                                    @if($inst->alamat_instansi)
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-map-marker-alt"></i> {{ Str::limit($inst->alamat_instansi, 50) }}
                                                        </small>
                                                    @endif
                                                    @if($inst->telepon_instansi)
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-phone"></i> {{ $inst->telepon_instansi }}
                                                        </small>
                                                    @endif
                                                    @if($inst->email_instansi)
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-envelope"></i> {{ $inst->email_instansi }}
                                                        </small>
                                                    @endif
                                                </div>
                                            @endif
                                            
                                            <!-- Actions -->
                                            <div class="mt-auto">
                                                <div class="btn-group w-100" role="group">
                                                    <a href="{{ route('panel.instansi.show', $inst->id) }}" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->instansi_id == $inst->id)
                                                        <a href="{{ route('panel.instansi.edit', $inst->id) }}" class="btn btn-outline-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->isSuperAdmin())
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $inst->id }}, '{{ $inst->nama_instansi }}')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    @endif
                                                </div>
                                                
                                                @if($inst->website_instansi)
                                                    <a href="{{ $inst->website_instansi }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                                        <i class="fas fa-globe"></i> Website
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $instansi->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-building fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Instansi</h5>
                            <p class="text-muted">Belum ada instansi yang terdaftar dalam sistem.</p>
                            @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('panel.instansi.create') }}" class="btn btn-primary">
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

<!-- Delete Confirmation Modal -->
@if(auth()->user()->isSuperAdmin())
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus instansi <strong id="instansiName"></strong>?</p>
                <p class="text-warning"><small>⚠️ Menghapus instansi akan mempengaruhi aplikasi dan users yang terkait!</small></p>
                <p class="text-danger"><small>❌ Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
function confirmDelete(instansiId, instansiName) {
    document.getElementById('instansiName').textContent = instansiName;
    document.getElementById('deleteForm').action = `/panel/instansi/${instansiId}`;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush

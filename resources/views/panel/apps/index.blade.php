<x-app>
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
                                    <li class="breadcrumb-item active" aria-current="page">Aplikasi</li>
                                </ol>
                            </nav>
                            <h4 class="mb-0">
                                <i class="fas fa-mobile-alt text-primary"></i> Manajemen Aplikasi
                            </h4>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                                <a href="{{ route('panel.apps.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Aplikasi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('panel.apps.index') }}">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Filter by Instansi</label>
                                <select name="instansi_id" class="form-select">
                                    <option value="">Semua Instansi</option>
                                    @foreach($instansi as $inst)
                                        <option value="{{ $inst->id }}" {{ request('instansi_id') == $inst->id ? 'selected' : '' }}>
                                            {{ $inst->nama_instansi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cari Aplikasi</label>
                                <input type="text" name="search" class="form-control" placeholder="Nama atau kode aplikasi..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('panel.apps.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
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
                        <i class="fas fa-th-large"></i> Daftar Aplikasi ({{ $apps->total() }})
                    </h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success">{{ $apps->where('is_active', 1)->count() }} Aktif</span>
                        <span class="badge bg-secondary">{{ $apps->where('is_active', 0)->count() }} Nonaktif</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($apps->count() > 0)
                        <div class="row">
                            @foreach($apps as $app)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100 border {{ $app->is_active ? 'border-success' : 'border-secondary' }}">
                                        <div class="card-body d-flex flex-column">
                                            <div class="text-center mb-3">
                                                @if($app->logo_app)
                                                    <img src="{{ asset('storage/' . $app->logo_app) }}" 
                                                         alt="Logo {{ $app->nama_app }}" 
                                                         class="rounded-circle" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-{{ $app->is_active ? 'primary' : 'secondary' }} text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                        <i class="fas fa-cube fa-2x"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <h6 class="text-center mb-2">{{ $app->nama_app }}</h6>
                                            <p class="text-muted small text-center mb-2">
                                                <i class="fas fa-code"></i> {{ $app->kode_app }}
                                            </p>
                                            <p class="text-muted small text-center mb-3 flex-grow-1">
                                                {{ Str::limit($app->deskripsi_app ?: 'Deskripsi belum tersedia', 80) }}
                                            </p>
                                            
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-building"></i> {{ $app->instansi->nama_instansi }}
                                                    </small>
                                                    <span class="badge bg-{{ $app->is_active ? 'success' : 'secondary' }}">
                                                        {{ $app->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </div>
                                                
                                                <div class="d-grid gap-2">
                                                    @if($app->url_app && $app->is_active)
                                                        <a href="{{ $app->url_app }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-external-link-alt"></i> Buka App
                                                        </a>
                                                    @endif
                                                    
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('panel.apps.show', $app->id) }}" class="btn btn-outline-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                        @if(auth()->user()->isSuperAdmin() || (auth()->user()->isAdmin() && auth()->user()->instansi_id == $app->instansi_id) || auth()->user()->app_id == $app->id)
                                                            <a href="{{ route('panel.apps.edit', $app->id) }}" class="btn btn-outline-warning btn-sm">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                        @endif
                                                        @if(auth()->user()->isSuperAdmin())
                                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $app->id }}, '{{ $app->nama_app }}')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $apps->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-mobile-alt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Aplikasi</h5>
                            <p class="text-muted">
                                @if(request()->has('search') || request()->has('instansi_id') || request()->has('status'))
                                    Tidak ada aplikasi yang sesuai dengan filter yang dipilih.
                                @else
                                    Belum ada aplikasi yang terdaftar dalam sistem.
                                @endif
                            </p>
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                                <a href="{{ route('panel.apps.create') }}" class="btn btn-primary">
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

<!-- Delete Confirmation Modal -->
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
                <p>Yakin ingin menghapus aplikasi <strong id="appName"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
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
</x-app>

@push('scripts')
<script>
function confirmDelete(appId, appName) {
    document.getElementById('appName').textContent = appName;
    document.getElementById('deleteForm').action = `/panel/apps/${appId}`;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush
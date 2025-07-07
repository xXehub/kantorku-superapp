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
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('panel.instansi.index') }}">Instansi</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                </ol>
                            </nav>
                            <h4 class="mb-0">
                                <i class="fas fa-edit text-warning"></i> Edit Instansi: {{ $instansi->nama_instansi }}
                            </h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('panel.instansi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-building"></i> Informasi Instansi
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.instansi.update', $instansi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Kode Instansi -->
                            <div class="col-md-6 mb-3">
                                <label for="kode_instansi" class="form-label">
                                    <i class="fas fa-code text-primary"></i> Kode Instansi <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('kode_instansi') is-invalid @enderror" 
                                       id="kode_instansi" 
                                       name="kode_instansi" 
                                       value="{{ old('kode_instansi', $instansi->kode_instansi) }}" 
                                       placeholder="e.g., DISKOMINFO, DINAS_PERHUB, etc.">
                                @error('kode_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Instansi -->
                            <div class="col-md-6 mb-3">
                                <label for="nama_instansi" class="form-label">
                                    <i class="fas fa-building text-success"></i> Nama Instansi <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama_instansi') is-invalid @enderror" 
                                       id="nama_instansi" 
                                       name="nama_instansi" 
                                       value="{{ old('nama_instansi', $instansi->nama_instansi) }}" 
                                       placeholder="e.g., Dinas Komunikasi dan Informatika">
                                @error('nama_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12 mb-3">
                                <label for="deskripsi_instansi" class="form-label">
                                    <i class="fas fa-align-left text-info"></i> Deskripsi Instansi
                                </label>
                                <textarea class="form-control @error('deskripsi_instansi') is-invalid @enderror" 
                                          id="deskripsi_instansi" 
                                          name="deskripsi_instansi" 
                                          rows="4" 
                                          placeholder="Deskripsi singkat tentang instansi dan tugas pokok fungsinya">{{ old('deskripsi_instansi', $instansi->deskripsi_instansi) }}</textarea>
                                @error('deskripsi_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-6 mb-3">
                                <label for="alamat_instansi" class="form-label">
                                    <i class="fas fa-map-marker-alt text-danger"></i> Alamat Instansi
                                </label>
                                <textarea class="form-control @error('alamat_instansi') is-invalid @enderror" 
                                          id="alamat_instansi" 
                                          name="alamat_instansi" 
                                          rows="3" 
                                          placeholder="Alamat lengkap instansi">{{ old('alamat_instansi', $instansi->alamat_instansi) }}</textarea>
                                @error('alamat_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kontak -->
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <!-- Telepon -->
                                    <div class="col-12 mb-3">
                                        <label for="telepon_instansi" class="form-label">
                                            <i class="fas fa-phone text-success"></i> Telepon
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('telepon_instansi') is-invalid @enderror" 
                                               id="telepon_instansi" 
                                               name="telepon_instansi" 
                                               value="{{ old('telepon_instansi', $instansi->telepon_instansi) }}" 
                                               placeholder="e.g., (031) 1234567">
                                        @error('telepon_instansi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-12 mb-3">
                                        <label for="email_instansi" class="form-label">
                                            <i class="fas fa-envelope text-primary"></i> Email
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email_instansi') is-invalid @enderror" 
                                               id="email_instansi" 
                                               name="email_instansi" 
                                               value="{{ old('email_instansi', $instansi->email_instansi) }}" 
                                               placeholder="e.g., info@instansi.surabaya.go.id">
                                        @error('email_instansi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Website -->
                                    <div class="col-12 mb-3">
                                        <label for="website_instansi" class="form-label">
                                            <i class="fas fa-globe text-info"></i> Website
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('website_instansi') is-invalid @enderror" 
                                               id="website_instansi" 
                                               name="website_instansi" 
                                               value="{{ old('website_instansi', $instansi->website_instansi) }}" 
                                               placeholder="https://instansi.surabaya.go.id">
                                        @error('website_instansi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-12 mb-3">
                                <label for="is_active" class="form-label">
                                    <i class="fas fa-toggle-on text-success"></i> Status Instansi
                                </label>
                                <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $instansi->is_active) == 1 ? 'selected' : '' }}>
                                        ✅ Aktif
                                    </option>
                                    <option value="0" {{ old('is_active', $instansi->is_active) == 0 ? 'selected' : '' }}>
                                        ❌ Nonaktif
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Instansi
                                        </button>
                                        <a href="{{ route('panel.instansi.index') }}" class="btn btn-secondary ms-2">
                                            <i class="fas fa-times"></i> Batal
                                        </a>
                                    </div>
                                    @if(auth()->user()->isSuperAdmin())
                                        <div>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                                <i class="fas fa-trash"></i> Hapus Instansi
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Instansi Stats & Apps -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle text-info"></i> Informasi Instansi
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $instansi->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Aplikasi:</strong></td>
                            <td>{{ $instansi->apps->count() }} aplikasi</td>
                        </tr>
                        <tr>
                            <td><strong>Aplikasi Aktif:</strong></td>
                            <td>{{ $instansi->apps->where('is_active', true)->count() }} aplikasi</td>
                        </tr>
                        <tr>
                            <td><strong>Total Users:</strong></td>
                            <td>{{ $instansi->users->count() }} users</td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat pada:</strong></td>
                            <td>{{ $instansi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Terakhir diupdate:</strong></td>
                            <td>{{ $instansi->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if($instansi->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-mobile-alt text-primary"></i> Aplikasi ({{ $instansi->apps->count() }})
                    </h6>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->instansi_id == $instansi->id)
                        <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($instansi->apps->count() > 0)
                        @foreach($instansi->apps->take(5) as $app)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>{{ $app->nama_app }}</strong>
                                    <br><small class="text-muted">{{ $app->kode_app }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $app->is_active ? 'success' : 'secondary' }}">
                                        {{ $app->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->instansi_id == $instansi->id)
                                        <a href="{{ route('panel.apps.edit', $app->id) }}" class="btn btn-xs btn-outline-warning ms-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr class="my-2">
                            @endif
                        @endforeach
                        
                        @if($instansi->apps->count() > 5)
                            <div class="text-center mt-3">
                                <a href="{{ route('panel.apps.index') }}?instansi_id={{ $instansi->id }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> Lihat Semua ({{ $instansi->apps->count() }} aplikasi)
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-muted text-center">Belum ada aplikasi terdaftar.</p>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->instansi_id == $instansi->id)
                            <div class="text-center">
                                <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus"></i> Tambah Aplikasi Pertama
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Users in Instansi -->
    @if($instansi->users->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-users text-success"></i> Users di Instansi ({{ $instansi->users->count() }})
                        </h6>
                        @if(auth()->user()->isSuperAdmin())
                            <a href="{{ route('panel.users.index') }}?instansi_id={{ $instansi->id }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i> Kelola Users
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($instansi->users->take(6) as $user)
                                <div class="col-md-4 mb-3">
                                    <div class="card border">
                                        <div class="card-body p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <span class="small">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                                    <small class="text-muted">{{ $user->role ? $user->role->nama_role : 'No Role' }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($instansi->users->count() > 6)
                            <div class="text-center">
                                <a href="{{ route('panel.users.index') }}?instansi_id={{ $instansi->id }}" class="btn btn-outline-info">
                                    <i class="fas fa-eye"></i> Lihat Semua Users ({{ $instansi->users->count() }})
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if(auth()->user()->isSuperAdmin())
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
                <p>Yakin ingin menghapus instansi <strong>{{ $instansi->nama_instansi }}</strong>?</p>
                <p class="text-warning"><small>⚠️ Menghapus instansi akan mempengaruhi {{ $instansi->apps->count() }} aplikasi dan {{ $instansi->users->count() }} users!</small></p>
                <p class="text-danger"><small>❌ Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('panel.instansi.destroy', $instansi->id) }}" method="POST" class="d-inline">
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
</x-app>
@push('scripts')
<script>
function confirmDelete() {
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush

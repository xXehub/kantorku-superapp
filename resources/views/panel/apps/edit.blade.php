@extends('layouts.app')

@section('title', 'Edit Aplikasi - Panel')

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
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('panel.apps.index') }}">Aplikasi</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                </ol>
                            </nav>
                            <h4 class="mb-0">
                                <i class="fas fa-edit text-warning"></i> Edit Aplikasi: {{ $app->nama_app }}
                            </h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('panel.apps.index') }}" class="btn btn-secondary">
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
                        <i class="fas fa-mobile-alt"></i> Informasi Aplikasi
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.apps.update', $app->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Kode Aplikasi -->
                            <div class="col-md-6 mb-3">
                                <label for="kode_app" class="form-label">
                                    <i class="fas fa-code text-primary"></i> Kode Aplikasi <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('kode_app') is-invalid @enderror" 
                                       id="kode_app" 
                                       name="kode_app" 
                                       value="{{ old('kode_app', $app->kode_app) }}" 
                                       placeholder="e.g., SIPD, SIMPEG, etc.">
                                @error('kode_app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Aplikasi -->
                            <div class="col-md-6 mb-3">
                                <label for="nama_app" class="form-label">
                                    <i class="fas fa-tag text-success"></i> Nama Aplikasi <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama_app') is-invalid @enderror" 
                                       id="nama_app" 
                                       name="nama_app" 
                                       value="{{ old('nama_app', $app->nama_app) }}" 
                                       placeholder="e.g., Sistem Perencanaan Pembangunan Daerah">
                                @error('nama_app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instansi -->
                            <div class="col-md-6 mb-3">
                                <label for="instansi_id" class="form-label">
                                    <i class="fas fa-building text-info"></i> Instansi <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('instansi_id') is-invalid @enderror" id="instansi_id" name="instansi_id">
                                    <option value="">Pilih Instansi</option>
                                    @foreach($instansi as $inst)
                                        <option value="{{ $inst->id }}" 
                                                {{ old('instansi_id', $app->instansi_id) == $inst->id ? 'selected' : '' }}>
                                            {{ $inst->nama_instansi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instansi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- URL Aplikasi -->
                            <div class="col-md-6 mb-3">
                                <label for="url_app" class="form-label">
                                    <i class="fas fa-link text-primary"></i> URL Aplikasi
                                </label>
                                <input type="url" 
                                       class="form-control @error('url_app') is-invalid @enderror" 
                                       id="url_app" 
                                       name="url_app" 
                                       value="{{ old('url_app', $app->url_app) }}" 
                                       placeholder="https://example.com">
                                @error('url_app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12 mb-3">
                                <label for="deskripsi_app" class="form-label">
                                    <i class="fas fa-align-left text-secondary"></i> Deskripsi Aplikasi
                                </label>
                                <textarea class="form-control @error('deskripsi_app') is-invalid @enderror" 
                                          id="deskripsi_app" 
                                          name="deskripsi_app" 
                                          rows="4" 
                                          placeholder="Deskripsi singkat tentang aplikasi">{{ old('deskripsi_app', $app->deskripsi_app) }}</textarea>
                                @error('deskripsi_app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="logo_app" class="form-label">
                                    <i class="fas fa-image text-warning"></i> Logo Aplikasi
                                </label>
                                <input type="file" 
                                       class="form-control @error('logo_app') is-invalid @enderror" 
                                       id="logo_app" 
                                       name="logo_app" 
                                       accept="image/*">
                                @error('logo_app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($app->logo_app)
                                    <div class="mt-2">
                                        <small class="text-muted">Logo saat ini:</small><br>
                                        <img src="{{ asset('storage/' . $app->logo_app) }}" 
                                             alt="Logo {{ $app->nama_app }}" 
                                             class="img-thumbnail mt-1" 
                                             style="max-width: 100px; max-height: 100px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="is_active" class="form-label">
                                    <i class="fas fa-toggle-on text-success"></i> Status Aplikasi
                                </label>
                                <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $app->is_active) == 1 ? 'selected' : '' }}>
                                        <i class="fas fa-check-circle text-success"></i> Aktif
                                    </option>
                                    <option value="0" {{ old('is_active', $app->is_active) == 0 ? 'selected' : '' }}>
                                        <i class="fas fa-times-circle text-danger"></i> Nonaktif
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
                                            <i class="fas fa-save"></i> Update Aplikasi
                                        </button>
                                        <a href="{{ route('panel.apps.index') }}" class="btn btn-secondary ms-2">
                                            <i class="fas fa-times"></i> Batal
                                        </a>
                                    </div>
                                    @if(auth()->user()->isSuperAdmin())
                                        <div>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                                <i class="fas fa-trash"></i> Hapus Aplikasi
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

    <!-- App Info -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle text-info"></i> Informasi Aplikasi
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $app->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat oleh:</strong></td>
                            <td>{{ $app->creator ? $app->creator->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat pada:</strong></td>
                            <td>{{ $app->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Terakhir diupdate:</strong></td>
                            <td>{{ $app->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if($app->is_active)
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
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-users text-primary"></i> Users Terkait
                    </h6>
                </div>
                <div class="card-body">
                    @if($app->users->count() > 0)
                        @foreach($app->users as $user)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    <br><small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <span class="badge bg-info">{{ $user->role ? $user->role->nama_role : 'No Role' }}</span>
                            </div>
                            @if(!$loop->last)
                                <hr class="my-2">
                            @endif
                        @endforeach
                    @else
                        <p class="text-muted text-center">Belum ada user yang mengelola aplikasi ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
                <p>Yakin ingin menghapus aplikasi <strong>{{ $app->nama_app }}</strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('panel.apps.destroy', $app->id) }}" method="POST" class="d-inline">
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
function confirmDelete() {
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush

@extends('layouts.app')

@section('title', 'Edit Aplikasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Edit Aplikasi: {{ $masterApp->nama_app }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('master.master-app.update', $masterApp) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kode_app" class="form-label">Kode Aplikasi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('kode_app') is-invalid @enderror" 
                                           id="kode_app" 
                                           name="kode_app" 
                                           value="{{ old('kode_app', $masterApp->kode_app) }}" 
                                           required
                                           placeholder="Contoh: SIMPEG">
                                    @error('kode_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama_app" class="form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nama_app') is-invalid @enderror" 
                                           id="nama_app" 
                                           name="nama_app" 
                                           value="{{ old('nama_app', $masterApp->nama_app) }}" 
                                           required
                                           placeholder="Contoh: Sistem Informasi Kepegawaian">
                                    @error('nama_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="deskripsi_app" class="form-label">Deskripsi Aplikasi</label>
                            <textarea class="form-control @error('deskripsi_app') is-invalid @enderror" 
                                      id="deskripsi_app" 
                                      name="deskripsi_app" 
                                      rows="3"
                                      placeholder="Deskripsi singkat tentang aplikasi">{{ old('deskripsi_app', $masterApp->deskripsi_app) }}</textarea>
                            @error('deskripsi_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="url_app" class="form-label">URL Aplikasi</label>
                                    <input type="url" 
                                           class="form-control @error('url_app') is-invalid @enderror" 
                                           id="url_app" 
                                           name="url_app" 
                                           value="{{ old('url_app', $masterApp->url_app) }}"
                                           placeholder="https://simpeg.surabaya.go.id">
                                    @error('url_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="instansi_id" class="form-label">Instansi <span class="text-danger">*</span></label>
                                    <select class="form-control @error('instansi_id') is-invalid @enderror" 
                                            id="instansi_id" 
                                            name="instansi_id" 
                                            required>
                                        <option value="">Pilih Instansi</option>
                                        @foreach($instansi as $item)
                                            <option value="{{ $item->id }}" {{ old('instansi_id', $masterApp->instansi_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->kode_instansi }} - {{ $item->nama_instansi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('instansi_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $masterApp->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Aplikasi Aktif
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('master.master-app.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Aplikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

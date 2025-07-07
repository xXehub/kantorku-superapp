@extends('layouts.app')

@section('title', 'Tambah Instansi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle"></i> Tambah Instansi Baru
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('master.instansi.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kode_instansi" class="form-label">Kode Instansi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('kode_instansi') is-invalid @enderror" 
                                           id="kode_instansi" 
                                           name="kode_instansi" 
                                           value="{{ old('kode_instansi') }}" 
                                           required
                                           placeholder="Contoh: DISKOMINFO">
                                    @error('kode_instansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama_instansi" class="form-label">Nama Instansi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nama_instansi') is-invalid @enderror" 
                                           id="nama_instansi" 
                                           name="nama_instansi" 
                                           value="{{ old('nama_instansi') }}" 
                                           required
                                           placeholder="Contoh: Dinas Komunikasi dan Informatika">
                                    @error('nama_instansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="deskripsi_instansi" class="form-label">Deskripsi Instansi</label>
                            <textarea class="form-control @error('deskripsi_instansi') is-invalid @enderror" 
                                      id="deskripsi_instansi" 
                                      name="deskripsi_instansi" 
                                      rows="3"
                                      placeholder="Deskripsi singkat tentang instansi">{{ old('deskripsi_instansi') }}</textarea>
                            @error('deskripsi_instansi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                                    <textarea class="form-control @error('alamat_instansi') is-invalid @enderror" 
                                              id="alamat_instansi" 
                                              name="alamat_instansi" 
                                              rows="2"
                                              placeholder="Alamat lengkap instansi">{{ old('alamat_instansi') }}</textarea>
                                    @error('alamat_instansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="telepon_instansi" class="form-label">Telepon Instansi</label>
                                    <input type="text" 
                                           class="form-control @error('telepon_instansi') is-invalid @enderror" 
                                           id="telepon_instansi" 
                                           name="telepon_instansi" 
                                           value="{{ old('telepon_instansi') }}"
                                           placeholder="Contoh: (031) 1234567">
                                    @error('telepon_instansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="email_instansi" class="form-label">Email Instansi</label>
                                    <input type="email" 
                                           class="form-control @error('email_instansi') is-invalid @enderror" 
                                           id="email_instansi" 
                                           name="email_instansi" 
                                           value="{{ old('email_instansi') }}"
                                           placeholder="Contoh: info@diskominfo.surabaya.go.id">
                                    @error('email_instansi')
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
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Instansi Aktif
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('master.instansi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Instansi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

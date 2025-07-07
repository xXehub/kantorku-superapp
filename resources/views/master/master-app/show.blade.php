@extends('layouts.app')

@section('title', 'Detail Aplikasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye"></i> Detail Aplikasi: {{ $masterApp->nama_app }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kode Aplikasi:</strong></td>
                                    <td>{{ $masterApp->kode_app }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Aplikasi:</strong></td>
                                    <td>{{ $masterApp->nama_app }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Instansi:</strong></td>
                                    <td>
                                        @if($masterApp->instansi)
                                            <span class="badge bg-primary">{{ $masterApp->instansi->kode_instansi }}</span>
                                            {{ $masterApp->instansi->nama_instansi }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>URL Aplikasi:</strong></td>
                                    <td>
                                        @if($masterApp->url_app)
                                            <a href="{{ $masterApp->url_app }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> Buka Aplikasi
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($masterApp->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Dibuat Oleh:</strong></td>
                                    <td>
                                        @if($masterApp->creator)
                                            {{ $masterApp->creator->name }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Dibuat:</strong></td>
                                    <td>{{ $masterApp->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diubah:</strong></td>
                                    <td>{{ $masterApp->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($masterApp->deskripsi_app)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Deskripsi:</strong></h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $masterApp->deskripsi_app }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('master.master-app.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        <div>
                            @php
                                $user = auth()->user();
                                $canEdit = $user->is_superadmin || ($user->role && $user->role->nama_role === 'Administrator' && $user->app_id === $masterApp->id);
                            @endphp
                            
                            @if($canEdit)
                                <a href="{{ route('master.master-app.edit', $masterApp) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <form action="{{ route('master.master-app.destroy', $masterApp) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

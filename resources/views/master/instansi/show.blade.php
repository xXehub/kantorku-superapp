@extends('layouts.app')

@section('title', 'Detail Instansi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye"></i> Detail Instansi: {{ $instansi->nama_instansi }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kode Instansi:</strong></td>
                                    <td><span class="badge bg-primary">{{ $instansi->kode_instansi }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Instansi:</strong></td>
                                    <td>{{ $instansi->nama_instansi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon:</strong></td>
                                    <td>{{ $instansi->telepon_instansi ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>
                                        @if($instansi->email_instansi)
                                            <a href="mailto:{{ $instansi->email_instansi }}">{{ $instansi->email_instansi }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($instansi->is_active)
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
                                    <td><strong>Tanggal Dibuat:</strong></td>
                                    <td>{{ $instansi->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diubah:</strong></td>
                                    <td>{{ $instansi->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Aplikasi:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $instansi->masterApps->count() }} Aplikasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Total Pengguna:</strong></td>
                                    <td>
                                        <span class="badge bg-warning">{{ $instansi->users->count() }} Pengguna</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($instansi->alamat_instansi)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Alamat:</strong></h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $instansi->alamat_instansi }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($instansi->deskripsi_instansi)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Deskripsi:</strong></h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $instansi->deskripsi_instansi }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Aplikasi List -->
                    @if($instansi->masterApps->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6><strong>Aplikasi yang Dimiliki:</strong></h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Aplikasi</th>
                                            <th>URL</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instansi->masterApps as $app)
                                        <tr>
                                            <td><span class="badge bg-secondary">{{ $app->kode_app }}</span></td>
                                            <td>{{ $app->nama_app }}</td>
                                            <td>
                                                @if($app->url_app)
                                                    <a href="{{ $app->url_app }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($app->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('master.instansi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        <div>
                            @php
                                $user = auth()->user();
                                $canEdit = $user->is_superadmin;
                            @endphp
                            
                            @if($canEdit)
                                <a href="{{ route('master.instansi.edit', $instansi) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <form action="{{ route('master.instansi.destroy', $instansi) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus instansi ini? Semua aplikasi dan pengguna terkait akan terpengaruh.')">
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

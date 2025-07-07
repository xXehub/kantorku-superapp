@extends('layouts.app')

@section('title', 'Detail Permission')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Permission: {{ $permission->display_name }}</h3>
                    <div>
                        <a href="{{ route('master.permissions.edit', $permission) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('master.permissions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 150px;">Permission Name:</th>
                                    <td><code>{{ $permission->name }}</code></td>
                                </tr>
                                <tr>
                                    <th>Display Name:</th>
                                    <td>{{ $permission->display_name }}</td>
                                </tr>
                                <tr>
                                    <th>Group:</th>
                                    <td><span class="badge bg-secondary">{{ ucfirst($permission->group) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $permission->description ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $permission->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $permission->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5>Role yang Memiliki Permission Ini:</h5>
                    
                    @if($permission->roles->count() > 0)
                        <div class="row">
                            @foreach($permission->roles as $role)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $role->nama_role }}</h6>
                                            <p class="card-text text-muted">{{ $role->description ?? 'No description' }}</p>
                                            @if($role->app)
                                                <p class="card-text">
                                                    <small class="text-muted">App: {{ $role->app->nama_app }}</small>
                                                </p>
                                            @else
                                                <p class="card-text">
                                                    <small class="text-muted">Global Role</small>
                                                </p>
                                            @endif
                                            <a href="{{ route('master.roles.show', $role) }}" class="btn btn-sm btn-outline-primary">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Permission ini belum diassign ke role manapun.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-cube text-primary"></i>
                        {{ $app->nama_app }} - {{ $instansi->nama_istansi }}
                        @if(auth()->user()->isSuperAdmin())
                            <span class="badge bg-danger ms-2">Super Admin</span>
                        @else
                            <span class="badge bg-info ms-2">{{ $userRole ? $userRole->nama_role : 'User' }}</span>
                        @endif
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Global Dashboard</a></li>
                            <li class="breadcrumb-item">{{ $instansi->nama_istansi }}</li>
                            <li class="breadcrumb-item active">{{ $app->nama_app }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="card-body">
                    <!-- App Info -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h5>Application Information</h5>
                            <p>{{ $app->deskripsi }}</p>
                            <p><strong>Version:</strong> {{ $stats['app_version'] }}</p>
                            <p><strong>Instansi:</strong> {{ $instansi->nama_istansi }} ({{ $instansi->kode_instansi }})</p>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="{{ $app->icon ?? 'fas fa-cube' }} fa-4x text-primary mb-3"></i>
                                    <h6>{{ $app->nama_app }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_users_in_app'] }}</h3>
                                    <p class="mb-0">Users in App</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['active_sessions'] }}</h3>
                                    <p class="mb-0">Active Sessions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['app_version'] }}</h3>
                                    <p class="mb-0">Version</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- App Features/Modules -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Available Features</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                            <h6>User Management</h6>
                                            <p class="text-muted">Manage app users</p>
                                            <button class="btn btn-sm btn-primary">Access</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-chart-bar fa-2x text-success mb-2"></i>
                                            <h6>Reports</h6>
                                            <p class="text-muted">View analytics</p>
                                            <button class="btn btn-sm btn-success">Access</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-cog fa-2x text-warning mb-2"></i>
                                            <h6>Settings</h6>
                                            <p class="text-muted">App configuration</p>
                                            <button class="btn btn-sm btn-warning">Access</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-database fa-2x text-info mb-2"></i>
                                            <h6>Data</h6>
                                            <p class="text-muted">Manage app data</p>
                                            <button class="btn btn-sm btn-info">Access</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Actions -->
                    @if(auth()->user()->isSuperAdmin() || (is_object($userRole) && in_array($userRole->name, ['admin', 'manager'])))
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Admin Actions</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="fas fa-users"></i> Manage Users
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <i class="fas fa-chart-line"></i> View Analytics
                                </button>
                                <button type="button" class="btn btn-outline-info">
                                    <i class="fas fa-cogs"></i> App Settings
                                </button>
                                @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('master.dashboard') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-crown"></i> Master Panel
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

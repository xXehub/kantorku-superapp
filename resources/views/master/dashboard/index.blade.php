@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-crown text-warning"></i>
                        Master Panel - Super Admin Dashboard
                        <span class="badge bg-danger ms-2">Super Admin</span>
                    </h4>
                </div>

                <div class="card-body">
                    <!-- Stats Row -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_users'] }}</h3>
                                    <p class="mb-0">Total Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_apps'] }}</h3>
                                    <p class="mb-0">Applications</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_instansi'] }}</h3>
                                    <p class="mb-0">Instansi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['total_roles'] }}</h3>
                                    <p class="mb-0">Roles</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $stats['pending_users'] }}</h3>
                                    <p class="mb-0">Pending Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-secondary text-white">
                                <div class="card-body text-center">
                                    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
                                        <i class="fas fa-home fa-2x"></i>
                                        <p class="mb-0 mt-2">Global Dashboard</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Management Buttons -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Master Management</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('master.users.index') }}" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-users"></i> Manage Users
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('master.roles.index') }}" class="btn btn-outline-success w-100 mb-2">
                                        <i class="fas fa-user-tag"></i> Manage Roles
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('master.master-app.index') }}" class="btn btn-outline-info w-100 mb-2">
                                        <i class="fas fa-cube"></i> Manage Apps
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('master.instansi.index') }}" class="btn btn-outline-warning w-100 mb-2">
                                        <i class="fas fa-building"></i> Manage Instansi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending User Assignments -->
                    @if($pendingUserApps->count() > 0)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Pending User App Assignments</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Current Role</th>
                                            <th>Registered</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingUserApps as $userApp)
                                        <tr>
                                            <td>{{ $userApp->user->name }}</td>
                                            <td>{{ $userApp->user->email }}</td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $userApp->role ? $userApp->role->nama_role : 'No Role' }}
                                                </span>
                                            </td>
                                            <td>{{ $userApp->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('master.users.edit', $userApp->user->id) }}" class="btn btn-sm btn-primary">
                                                    Assign App
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Recent Apps -->
                    @if($recentApps->count() > 0)
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Recent Applications</h5>
                            <div class="list-group">
                                @foreach($recentApps as $app)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $app->nama_app }}</h6>
                                        <p class="mb-1 text-muted">{{ Str::limit($app->deskripsi, 50) }}</p>
                                        <small>Created: {{ $app->created_at->diffForHumans() }}</small>
                                    </div>
                                    <a href="{{ route('master.master-app.show', $app->id) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Recent Users -->
                        <div class="col-md-6">
                            <h5>Recent Users</h5>
                            <div class="list-group">
                                @foreach($recentUsers as $user)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $user->name }}</h6>
                                        <p class="mb-1 text-muted">{{ $user->email }}</p>
                                        <small>Joined: {{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if($user->isSuperAdmin())
                                        <span class="badge bg-danger">Super Admin</span>
                                    @else
                                        <a href="{{ route('master.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    @endif
                                </div>
                                @endforeach
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

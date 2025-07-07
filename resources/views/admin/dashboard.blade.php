@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Admin Dashboard</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalUsers }}</h4>
                                            <p>Total Users</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalRoles }}</h4>
                                            <p>Total Roles</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-user-tag fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalApps }}</h4>
                                            <p>Total Apps</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-cube fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalInstansi }}</h4>
                                            <p>Total Instansi</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-building fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Create New Role</a>
                                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-warning">Add Permission</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Users</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentUsers->count() > 0)
                                        <div class="list-group">
                                            @foreach($recentUsers as $user)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $user->name }}</strong><br>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                    @if($user->isSuperAdmin())
                                                        <span class="badge bg-danger">Super Admin</span>
                                                    @elseif($user->isAdmin())
                                                        <span class="badge bg-warning">Admin</span>
                                                    @else
                                                        <span class="badge bg-info">User</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No users found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

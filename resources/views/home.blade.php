@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    @if(auth()->user()->isSuperAdmin())
                        <span class="badge bg-danger float-end">Super Admin</span>
                    @elseif(auth()->user()->isAdmin())
                        <span class="badge bg-warning float-end">Admin</span>
                    @else
                        <span class="badge bg-info float-end">User</span>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>Welcome, {{ auth()->user()->name }}!</h5>
                    <p>{{ __('You are logged in!') }}</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Your Status</h6>
                                    @if(auth()->user()->isSuperAdmin())
                                        <p class="card-text">Super Admin</p>
                                        <small class="text-muted">Full system access</small>
                                    @elseif(auth()->user()->isAdmin())
                                        <p class="card-text">Admin</p>
                                        <small class="text-muted">Administrative access</small>
                                    @else
                                        <p class="card-text">User</p>
                                        <small class="text-muted">Standard user access</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Account Info</h6>
                                    <p class="card-text">{{ auth()->user()->email }}</p>
                                    <small class="text-muted">Member since {{ auth()->user()->created_at->format('M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin())
                        <div class="mt-4">
                            <h6>Admin Quick Actions</h6>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Admin Dashboard</a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm">Manage Users</a>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary btn-sm">Manage Roles</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

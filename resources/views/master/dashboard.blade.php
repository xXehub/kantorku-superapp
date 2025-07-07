@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-tachometer-alt text-primary"></i> 
                        Dashboard Master - Kantorku Superapp Surabaya
                    </h4>
                    <p class="mb-0 text-muted">Sistem Manajemen Aplikasi Pemerintah Kota Surabaya</p>
                </div>

                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalUsers }}</h4>
                                            <p class="mb-0">Total Pengguna</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-primary border-0">
                                    <a href="{{ route('master.users.index') }}" class="text-white text-decoration-none">
                                        <small>Kelola Pengguna <i class="fas fa-arrow-right"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalRoles }}</h4>
                                            <p class="mb-0">Total Role</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-user-tag fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-success border-0">
                                    <a href="{{ route('master.roles.index') }}" class="text-white text-decoration-none">
                                        <small>Kelola Role <i class="fas fa-arrow-right"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalApps }}</h4>
                                            <p class="mb-0">Total Aplikasi</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-cube fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-warning border-0">
                                    <a href="{{ route('master.master-app.index') }}" class="text-white text-decoration-none">
                                        <small>Kelola Aplikasi <i class="fas fa-arrow-right"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalInstansi }}</h4>
                                            <p class="mb-0">Total Instansi</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-building fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-info border-0">
                                    <a href="{{ route('master.instansi.index') }}" class="text-white text-decoration-none">
                                        <small>Kelola Instansi <i class="fas fa-arrow-right"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Quick Actions -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="fas fa-user-plus"></i> Tambah Pengguna Baru
                                        </a>
                                        <a href="{{ route('admin.master-app.create') }}" class="btn btn-warning">
                                            <i class="fas fa-cube"></i> Buat Aplikasi Baru
                                        </a>
                                        <a href="{{ route('admin.instansi.create') }}" class="btn btn-info">
                                            <i class="fas fa-building"></i> Daftarkan Instansi
                                        </a>
                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                                            <i class="fas fa-user-tag"></i> Buat Role Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Users -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-users"></i> Pengguna Terbaru</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentUsers->count() > 0)
                                        <div class="list-group">
                                            @foreach($recentUsers as $user)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                        <br><small class="text-muted">{{ $user->email }}</small>
                                                        @if($user->instansi)
                                                            <br><small class="text-info">{{ $user->instansi->nama_instansi }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="text-end">
                                                        @if($user->is_superadmin)
                                                            <span class="badge bg-danger">Super Admin</span>
                                                        @elseif($user->role)
                                                            <span class="badge bg-primary">{{ $user->role->nama_role }}</span>
                                                        @else
                                                            <span class="badge bg-secondary">No Role</span>
                                                        @endif
                                                        <br><small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada pengguna terdaftar.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applications by Instansi -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-chart-pie"></i> Distribusi Aplikasi per Instansi</h5>
                                </div>
                                <div class="card-body">
                                    @if($appsByInstansi && count($appsByInstansi) > 0)
                                        <div class="row">
                                            @foreach($appsByInstansi as $instansi)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card border-left-primary">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                        {{ $instansi->kode_instansi }}
                                                                    </div>
                                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                        {{ $instansi->nama_instansi }}
                                                                    </div>
                                                                    <div class="text-muted">
                                                                        {{ $instansi->apps_count }} Aplikasi
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-building fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada data distribusi aplikasi.</p>
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

@extends('layouts.app')

@section('title', 'Manajemen Role')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user-tag text-success"></i> 
                        Manajemen Role Sistem
                    </h3>
                    <a href="{{ route('master.roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Role
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="rolesTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Role</th>
                                    <th>Deskripsi</th>
                                    <th>Aplikasi</th>
                                    <th>Default</th>
                                    <th>Jumlah Permission</th>
                                    <th>Jumlah Users</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $role->nama_role }}</span>
                                        </td>
                                        <td>{{ $role->description ?? '-' }}</td>
                                        <td>
                                            @if($role->app)
                                                <span class="badge bg-warning">{{ $role->app->kode_app }}</span>
                                                <br><small>{{ $role->app->nama_app }}</small>
                                            @else
                                                <span class="text-muted">Global Role</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($role->is_default)
                                                <span class="badge bg-success">Ya</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $role->permissions->count() ?? 0 }}</span>
                                            @if($role->permissions && $role->permissions->count() > 0)
                                                <br><small class="text-muted">Permission tersedia</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $role->users->count() ?? 0 }}</span>
                                            @if($role->users && $role->users->count() > 0)
                                                <br><small class="text-muted">User aktif</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('master.roles.show', $role) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('master.roles.edit', $role) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('master.roles.permissions', $role) }}" class="btn btn-sm btn-success" title="Kelola Permission">
                                                    <i class="fas fa-key"></i>
                                                </a>
                                                @if(!$role->is_default && $role->users->count() == 0)
                                                <form action="{{ route('master.roles.destroy', $role) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus role {{ $role->nama_role }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-user-tag fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada role yang dibuat</h5>
                                            <p class="text-muted">Mulai dengan membuat role pertama</p>
                                            <a href="{{ route('master.roles.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Buat Role Pertama
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#rolesTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        },
        columnDefs: [
            { orderable: false, targets: -1 } // Disable ordering on action column
        ],
        order: [[0, 'asc']] // Default sort by name
    });
});
</script>
@endpush
@endsection
                                        </td>
                                        <td>{{ $role->nama_role }}</td>
                                        <td>{{ $role->description ?? '-' }}</td>
                                        <td>
                                            @if($role->app)
                                                <span class="badge bg-info">{{ $role->app->nama_app }}</span>
                                            @else
                                                <span class="text-muted">Global</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($role->is_default)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                            <a href="{{ route('master.roles.permissions', $role) }}" class="btn btn-sm btn-outline-secondary ms-1">
                                                <i class="fas fa-cog"></i> Manage
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $role->users->count() }} users</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('master.roles.show', $role) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('master.roles.edit', $role) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(!in_array($role->name, ['admin', 'user']))
                                                    <form action="{{ route('master.roles.destroy', $role) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Yakin ingin menghapus role ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada role ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $role->instansi->count() }} Instansi</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @if(!in_array($role->name, ['admin', 'user']))
                                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">No roles found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

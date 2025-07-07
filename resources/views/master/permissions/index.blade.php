@extends('layouts.app')

@section('title', 'Manajemen Permission')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Manajemen Permission</h3>
                    <a href="{{ route('master.permissions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Permission
                    </a>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Filter by Group -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-select" id="groupFilter">
                                <option value="">Semua Group</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group }}">{{ ucfirst($group) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>Group</th>
                                    <th>Description</th>
                                    <th>Assigned Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $permission)
                                    <tr data-group="{{ $permission->group }}">
                                        <td><code>{{ $permission->name }}</code></td>
                                        <td>{{ $permission->display_name }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($permission->group) }}</span>
                                        </td>
                                        <td>{{ $permission->description ?? '-' }}</td>
                                        <td>
                                            @if($permission->roles->count() > 0)
                                                @foreach($permission->roles as $role)
                                                    <span class="badge bg-info me-1">{{ $role->nama_role }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('master.permissions.show', $permission) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('master.permissions.edit', $permission) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('master.permissions.destroy', $permission) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            onclick="return confirm('Yakin ingin menghapus permission ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada permission ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('groupFilter').addEventListener('change', function() {
    const selectedGroup = this.value;
    const rows = document.querySelectorAll('tbody tr[data-group]');
    
    rows.forEach(row => {
        if (selectedGroup === '' || row.dataset.group === selectedGroup) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection

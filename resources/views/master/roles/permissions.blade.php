@extends('layouts.app')

@section('title', 'Manajemen Permission Role')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Manajemen Permission: {{ $role->nama_role }}</h3>
                    <div>
                        <a href="{{ route('master.roles.show', $role) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Detail Role
                        </a>
                        <a href="{{ route('master.roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('master.roles.updatePermissions', $role) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Role Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <strong>Role Name:</strong><br>
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Display Name:</strong><br>
                                                {{ $role->nama_role }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong>App:</strong><br>
                                                {{ $role->app ? $role->app->nama_app : 'Global' }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Current Permissions:</strong><br>
                                                <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5>Select Permissions</h5>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAll()">
                                                Select All
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectNone()">
                                                Select None
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @foreach($permissionGroups as $group => $groupPermissions)
                                            <div class="permission-group mb-4">
                                                <h6 class="text-primary border-bottom pb-2">
                                                    <input type="checkbox" class="form-check-input me-2 group-checkbox" 
                                                           data-group="{{ $group }}" onchange="toggleGroup('{{ $group }}')">
                                                    {{ ucfirst($group) }} Permissions
                                                </h6>
                                                
                                                <div class="row">
                                                    @foreach($groupPermissions as $permission)
                                                        <div class="col-md-6 col-lg-4 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox group-{{ $group }}" 
                                                                       type="checkbox" 
                                                                       name="permissions[]" 
                                                                       value="{{ $permission->id }}" 
                                                                       id="permission_{{ $permission->id }}"
                                                                       {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                                                       onchange="updateGroupCheckbox('{{ $group }}')">
                                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                                    <strong>{{ $permission->display_name }}</strong>
                                                                    <br>
                                                                    <small class="text-muted">{{ $permission->name }}</small>
                                                                    @if($permission->description)
                                                                        <br>
                                                                        <small class="text-secondary">{{ $permission->description }}</small>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Permissions
                                </button>
                                <a href="{{ route('master.roles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function selectAll() {
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
    document.querySelectorAll('.group-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
}

function selectNone() {
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    document.querySelectorAll('.group-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
}

function toggleGroup(group) {
    const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);
    const permissions = document.querySelectorAll(`.group-${group}`);
    
    permissions.forEach(permission => {
        permission.checked = groupCheckbox.checked;
    });
}

function updateGroupCheckbox(group) {
    const permissions = document.querySelectorAll(`.group-${group}`);
    const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);
    
    const checkedCount = Array.from(permissions).filter(p => p.checked).length;
    const totalCount = permissions.length;
    
    if (checkedCount === 0) {
        groupCheckbox.checked = false;
        groupCheckbox.indeterminate = false;
    } else if (checkedCount === totalCount) {
        groupCheckbox.checked = true;
        groupCheckbox.indeterminate = false;
    } else {
        groupCheckbox.checked = false;
        groupCheckbox.indeterminate = true;
    }
}

// Initialize group checkboxes on page load
document.addEventListener('DOMContentLoaded', function() {
    @foreach($permissionGroups as $group => $groupPermissions)
        updateGroupCheckbox('{{ $group }}');
    @endforeach
});
</script>
@endpush
@endsection

@extends('layouts.app')

@section('title', 'Tambah Permission')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tambah Permission Baru</h3>
                    <a href="{{ route('master.permissions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('master.permissions.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="e.g., users.create">
                                    <small class="form-text text-muted">Format: resource.action (e.g., users.create, apps.view)</small>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('display_name') is-invalid @enderror" 
                                           id="display_name" name="display_name" value="{{ old('display_name') }}" 
                                           placeholder="e.g., Create Users">
                                    @error('display_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="group" class="form-label">Group <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('group') is-invalid @enderror" 
                                           id="group" name="group" value="{{ old('group') }}" 
                                           placeholder="e.g., users, apps, instansi"
                                           list="groupSuggestions">
                                    <datalist id="groupSuggestions">
                                        @foreach($groups as $group)
                                            <option value="{{ $group }}">
                                        @endforeach
                                        <option value="users">
                                        <option value="roles">
                                        <option value="apps">
                                        <option value="instansi">
                                        <option value="permissions">
                                        <option value="general">
                                    </datalist>
                                    @error('group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" 
                                           id="description" name="description" value="{{ old('description') }}" 
                                           placeholder="Optional description">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Permission
                                    </button>
                                    <a href="{{ route('master.permissions.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
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
// Auto-generate display name from permission name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const displayNameField = document.getElementById('display_name');
    
    if (displayNameField.value === '' && name.includes('.')) {
        const parts = name.split('.');
        const resource = parts[0];
        const action = parts[1];
        
        const actionMap = {
            'view': 'View',
            'create': 'Create',
            'edit': 'Edit',
            'update': 'Update',
            'delete': 'Delete',
            'assign': 'Assign'
        };
        
        const resourceMap = {
            'users': 'Users',
            'roles': 'Roles',
            'apps': 'Apps',
            'instansi': 'Instansi',
            'permissions': 'Permissions'
        };
        
        const displayName = (actionMap[action] || action) + ' ' + (resourceMap[resource] || resource);
        displayNameField.value = displayName;
    }
});

// Auto-fill group from permission name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const groupField = document.getElementById('group');
    
    if (groupField.value === '' && name.includes('.')) {
        const resource = name.split('.')[0];
        groupField.value = resource;
    }
});
</script>
@endpush
@endsection

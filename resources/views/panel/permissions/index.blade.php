<x-app>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <x-icon name="shield" class="me-2" />
                    Manajemen Permission
                </h2>
                <div class="text-secondary mt-1">
                    Kelola hak akses sistem aplikasi
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                        <x-icon name="plus" class="me-1" />
                        Tambah Permission
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <x-icon name="list" class="me-2" />
                            Daftar Permission
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="permissionsTable" class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Group</th>
                                        <th>Description</th>
                                        <th>Roles Count</th>
                                        <th>Created</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Permission -->
<div class="modal modal-blur fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <x-icon name="plus" class="me-2" />
                    Tambah Permission Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPermissionForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="contoh: users.create" required>
                                <small class="form-hint">Nama permission (huruf kecil, pisahkan dengan titik)</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Display Name</label>
                                <input type="text" class="form-control" name="display_name" placeholder="contoh: Create Users">
                                <small class="form-hint">Nama yang ditampilkan (opsional)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Group</label>
                                <input type="text" class="form-control" name="group" placeholder="contoh: users">
                                <small class="form-hint">Grup permission (opsional)</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Deskripsi permission"></textarea>
                                <small class="form-hint">Deskripsi permission (opsional)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <x-icon name="plus" class="me-1" />
                        Tambah Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Permission -->
<div class="modal modal-blur fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <x-icon name="edit" class="me-2" />
                    Edit Permission
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPermissionForm">
                <input type="hidden" id="edit_permission_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                                <small class="form-hint">Nama permission (huruf kecil, pisahkan dengan titik)</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Display Name</label>
                                <input type="text" class="form-control" id="edit_display_name" name="display_name">
                                <small class="form-hint">Nama yang ditampilkan (opsional)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Group</label>
                                <input type="text" class="form-control" id="edit_group" name="group">
                                <small class="form-hint">Grup permission (opsional)</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                                <small class="form-hint">Deskripsi permission (opsional)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <x-icon name="check" class="me-1" />
                        Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View Permission -->
<div class="modal modal-blur fade" id="viewPermissionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <x-icon name="eye" class="me-2" />
                    Detail Permission
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div id="view_name" class="form-control-plaintext"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Display Name</label>
                            <div id="view_display_name" class="form-control-plaintext"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <div id="view_group" class="form-control-plaintext"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Roles Count</label>
                            <div id="view_roles_count" class="form-control-plaintext"></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <div id="view_description" class="form-control-plaintext"></div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Created At</label>
                            <div id="view_created_at" class="form-control-plaintext"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Updated At</label>
                            <div id="view_updated_at" class="form-control-plaintext"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Tutup
                </a>
            </div>
        </div>
    </div>
</div>
</x-app>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    console.log('Initializing DataTable...');
    console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
    
    let table = $('#permissionsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '/api/panel/permissions',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(xhr, error, thrown) {
                console.error('DataTable AJAX Error:', {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                    error: error,
                    thrown: thrown
                });
                
                // Show user-friendly error
                Swal.fire({
                    icon: 'error',
                    title: 'Error Loading Data',
                    text: 'Status: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.statusText || 'Unknown error'),
                    footer: 'Check browser console for more details'
                });
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
            { data: 'name', name: 'name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'group', name: 'group' },
            { 
                data: 'description', 
                name: 'description',
                render: function(data) {
                    if (data && data !== '-') {
                        return data.length > 50 ? data.substring(0, 50) + '...' : data;
                    }
                    return '-';
                }
            },
            { 
                data: 'roles_count', 
                name: 'roles_count',
                className: 'text-center',
                render: function(data) {
                    return '<span class="badge bg-primary">' + data + '</span>';
                }
            },
            { data: 'created_at', name: 'created_at' },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewPermission(${row.id})" title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="editPermission(${row.id})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deletePermission(${row.id}, '${row.name}')" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3,6 5,6 21,6"></polyline>
                                    <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                </svg>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            processing: "Memuat data...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            loadingRecords: "Memuat...",
            zeroRecords: "Tidak ada data yang ditemukan",
            emptyTable: "Tidak ada data tersedia",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        order: [[6, 'desc']]
    });

    // Add Permission Form Submit
    $('#addPermissionForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let submitButton = $(this).find('button[type="submit"]');
        let originalText = submitButton.html();
        
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');
        
        $.ajax({
            url: '/api/panel/permissions',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#addPermissionModal').modal('hide');
                    $('#addPermissionForm')[0].reset();
                    table.ajax.reload();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let message = xhr.responseJSON?.message || 'Terjadi kesalahan';
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                
                // Show validation errors
                $.each(errors, function(field, messages) {
                    let input = $(`[name="${field}"]`);
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                });
                
                if (Object.keys(errors).length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message
                    });
                }
            },
            complete: function() {
                submitButton.prop('disabled', false).html(originalText);
            }
        });
    });

    // Edit Permission Form Submit
    $('#editPermissionForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let id = $('#edit_permission_id').val();
        let submitButton = $(this).find('button[type="submit"]');
        let originalText = submitButton.html();
        
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Mengupdate...');
        
        $.ajax({
            url: '/api/panel/permissions/' + id,
            type: 'PUT',
            data: Object.fromEntries(formData),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#editPermissionModal').modal('hide');
                    table.ajax.reload();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let message = xhr.responseJSON?.message || 'Terjadi kesalahan';
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                
                // Show validation errors
                $.each(errors, function(field, messages) {
                    let input = $(`#edit_${field}`);
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                });
                
                if (Object.keys(errors).length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message
                    });
                }
            },
            complete: function() {
                submitButton.prop('disabled', false).html(originalText);
            }
        });
    });
});

// View Permission Function
function viewPermission(id) {
    $.ajax({
        url: '/api/panel/permissions/' + id,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                let data = response.data;
                
                $('#view_name').text(data.name);
                $('#view_display_name').text(data.display_name || '-');
                $('#view_group').text(data.group || '-');
                $('#view_description').text(data.description || '-');
                $('#view_roles_count').html(`<span class="badge bg-primary">${data.roles_count}</span>`);
                $('#view_created_at').text(new Date(data.created_at).toLocaleString('id-ID'));
                $('#view_updated_at').text(new Date(data.updated_at).toLocaleString('id-ID'));
                
                $('#viewPermissionModal').modal('show');
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Gagal memuat data permission'
            });
        }
    });
}

// Edit Permission Function
function editPermission(id) {
    $.ajax({
        url: '/api/panel/permissions/' + id,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                let data = response.data;
                
                $('#edit_permission_id').val(data.id);
                $('#edit_name').val(data.name);
                $('#edit_display_name').val(data.display_name);
                $('#edit_group').val(data.group);
                $('#edit_description').val(data.description);
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                
                $('#editPermissionModal').modal('show');
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Gagal memuat data permission'
            });
        }
    });
}

// Delete Permission Function
function deletePermission(id, name) {
    Swal.fire({
        title: 'Hapus Permission?',
        text: `Yakin ingin menghapus permission "${name}"? Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/api/panel/permissions/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        table.ajax.reload();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    let message = xhr.responseJSON?.message || 'Gagal menghapus permission';
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message
                    });
                }
            });
        }
    });
}
</script>
@endpush
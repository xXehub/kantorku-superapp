@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users text-primary"></i> 
                        Manajemen Pengguna Sistem
                    </h4>
                    <a href="{{ route('master.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah Pengguna
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Instansi</th>
                                        <th>Aplikasi Dikelola</th>
                                        <th>Status</th>
                                        <th>Terakhir Login</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial rounded-circle bg-primary text-white me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                        @if($user->is_superadmin)
                                                            <br><small class="text-danger"><i class="fas fa-crown"></i> Super Administrator</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <code>{{ $user->username }}</code>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                @if($user->email_verified_at)
                                                    <br><small class="text-success"><i class="fas fa-check-circle"></i> Terverifikasi</small>
                                                @else
                                                    <br><small class="text-warning"><i class="fas fa-exclamation-circle"></i> Belum verifikasi</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->is_superadmin)
                                                    <span class="badge bg-danger">Super Administrator</span>
                                                @elseif($user->role)
                                                    <span class="badge bg-primary">{{ $user->role->nama_role }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum ada role</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->instansi)
                                                    <span class="badge bg-info">{{ $user->instansi->kode_instansi }}</span>
                                                    <br><small>{{ $user->instansi->nama_instansi }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->app)
                                                    <span class="badge bg-warning">{{ $user->app->kode_app }}</span>
                                                    <br><small>{{ $user->app->nama_app }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('master.users.show', $user) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('master.users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if(!$user->is_superadmin)
                                                    <form action="{{ route('master.users.destroy', $user) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5>Belum ada pengguna terdaftar</h5>
                            <p class="text-muted">Mulai dengan menambahkan pengguna pertama</p>
                            <a href="{{ route('master.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Tambah Pengguna Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
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
                                            <td>
                                                {{ $user->instansi ? $user->instansi->nama_instansi : '-' }}
                                            </td>
                                            <td>
                                                @if($user->managedApp)
                                                    <span class="badge bg-success">{{ $user->managedApp->nama_app }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @if($user->id !== auth()->id())
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
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

                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    @else
                        <p class="text-center text-muted">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

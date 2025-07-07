    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user text-primary"></i> Profil Saya
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @auth
                        <div class="text-center mb-3">
                            <div class="avatar avatar-xl mb-3">
                                <span class="avatar-title bg-primary rounded-circle fs-1">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <table class="table">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>{{ Auth::user()->username ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>
                                    @if (Auth::user()->role)
                                        <span class="badge bg-primary">{{ Auth::user()->role->nama_role }}</span>
                                    @else
                                        <span class="text-muted">Belum ada role</span>
                                    @endif
                                </td>
                            </tr>
                            @if (Auth::user()->instansi)
                                <tr>
                                    <td><strong>Instansi:</strong></td>
                                    <td>{{ Auth::user()->instansi->nama_instansi }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>Bergabung:</strong></td>
                                <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                            </tr>
                        </table>
                    @endauth
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
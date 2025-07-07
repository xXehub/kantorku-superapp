<x-app title="Modal Alert Examples">
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Modal Alert Examples
                        </h2>
                        <div class="text-secondary mt-1">
                            Contoh penggunaan Modal Alert Component
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    <!-- Backend Examples -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Backend Examples (PHP)</h3>
                            </div>
                            <div class="card-body">
                                <p class="text-secondary mb-3">
                                    Contoh penggunaan modal alert dari backend Laravel Controller
                                </p>

                                <div class="btn-list">
                                    <a href="{{ route('example.success') }}" class="btn btn-success">
                                        <i class="fas fa-check me-2"></i>
                                        Success Alert
                                    </a>

                                    <a href="{{ route('example.error') }}" class="btn btn-danger">
                                        <i class="fas fa-times me-2"></i>
                                        Error Alert
                                    </a>

                                    <a href="{{ route('example.warning') }}" class="btn btn-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Warning Alert
                                    </a>

                                    <a href="{{ route('example.info') }}" class="btn btn-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Info Alert
                                    </a>

                                    <a href="{{ route('example.custom') }}" class="btn btn-purple">
                                        <i class="fas fa-cog me-2"></i>
                                        Custom Alert
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Frontend Examples -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Frontend Examples (JavaScript)</h3>
                            </div>
                            <div class="card-body">
                                <p class="text-secondary mb-3">
                                    Contoh penggunaan modal alert dari frontend JavaScript
                                </p>

                                <div class="btn-list">
                                    <button type="button" class="btn btn-success" onclick="showSuccessJS()">
                                        <i class="fas fa-check me-2"></i>
                                        Success Alert
                                    </button>

                                    <button type="button" class="btn btn-danger" onclick="showErrorJS()">
                                        <i class="fas fa-times me-2"></i>
                                        Error Alert
                                    </button>

                                    <button type="button" class="btn btn-warning" onclick="showWarningJS()">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Warning Alert
                                    </button>

                                    <button type="button" class="btn btn-info" onclick="showInfoJS()">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Info Alert
                                    </button>

                                    <button type="button" class="btn btn-outline-warning" onclick="showConfirmJS()">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Confirmation
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Examples -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Advanced Examples</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Form Validation Example -->
                                    <div class="col-md-6">
                                        <h4>Form dengan Validasi</h4>
                                        <form action="{{ route('example.validate') }}" method="POST"
                                            onsubmit="return validateForm()">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Masukkan nama Anda">
                                                <div class="form-hint">Minimal 3 karakter</div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                Validasi & Simpan
                                            </button>
                                        </form>
                                    </div>

                                    <!-- AJAX Example -->
                                    <div class="col-md-6">
                                        <h4>AJAX Request Example</h4>
                                        <div class="mb-3">
                                            <label for="ajax-data" class="form-label">Data untuk AJAX</label>
                                            <input type="text" class="form-control" id="ajax-data"
                                                placeholder="Masukkan data">
                                        </div>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-success" onclick="ajaxSuccess()">
                                                AJAX Success
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="ajaxError()">
                                                AJAX Error
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Modal Examples -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Custom Modal Examples</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                    <button type="button" class="btn btn-primary" onclick="showCustomModal()">
                                        Custom dengan Callback
                                    </button>

                                    <button type="button" class="btn btn-warning" onclick="showDeleteConfirm()">
                                        Delete Confirmation
                                    </button>

                                    <button type="button" class="btn btn-info" onclick="showLogoutConfirm()">
                                        Logout Confirmation
                                    </button>

                                    <button type="button" class="btn btn-success" onclick="showPaymentSuccess()">
                                        Payment Success
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Fungsi helper untuk memastikan modalAlert sudah ready
            function withModalAlert(callback) {
                if (window.modalAlert) {
                    callback(window.modalAlert);
                } else {
                    // Fallback jika modalAlert belum ready
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            if (window.modalAlert) {
                                callback(window.modalAlert);
                            } else {
                                console.error('modalAlert still not available');
                            }
                        }, 100);
                    });
                }
            }

            // Frontend JavaScript Examples
            function showSuccessJS() {
                withModalAlert(function(modal) {
                    modal.success(
                        'Operasi Berhasil!',
                        'Data telah berhasil disimpan ke sistem.'
                    );
                });
            }

            function showErrorJS() {
                withModalAlert(function(modal) {
                    modal.error(
                        'Terjadi Kesalahan!',
                        'Koneksi ke server terputus. Silakan coba lagi.'
                    );
                });
            }

            function showWarningJS() {
                withModalAlert(function(modal) {
                    modal.warning(
                        'Peringatan Sistem!',
                        'Anda akan keluar dari halaman ini. Pastikan data sudah tersimpan.'
                    );
                });
            }

            function showInfoJS() {
                withModalAlert(function(modal) {
                    modal.info(
                        'Informasi Penting',
                        'Fitur baru akan segera diluncurkan minggu depan!'
                    );
                });
            }

            function showConfirmJS() {
                withModalAlert(function(modal) {
                    modal.show({
                        type: 'warning',
                        title: 'Konfirmasi Aksi',
                        message: 'Apakah Anda yakin ingin melanjutkan proses ini?',
                        primaryButton: 'Ya, Lanjutkan',
                        secondaryButton: 'Batal',
                        primaryAction: function() {
                            modal.success('Dikonfirmasi!', 'Proses berhasil dilanjutkan.');
                        },
                        secondaryAction: function() {
                            modal.info('Dibatalkan', 'Proses telah dibatalkan.');
                        }
                    });
                });
            }

            // Form Validation
            function validateForm() {
                const name = document.getElementById('name').value.trim();

                if (name === '') {
                    withModalAlert(function(modal) {
                        modal.warning('Validasi Gagal', 'Nama tidak boleh kosong!');
                    });
                    return false;
                }

                if (name.length < 3) {
                    withModalAlert(function(modal) {
                        modal.warning('Nama Terlalu Pendek', 'Nama harus minimal 3 karakter.');
                    });
                    return false;
                }

                withModalAlert(function(modal) {
                    modal.success('Validasi Berhasil!', 'Semua data sudah terisi dengan benar.');
                });
                return true;
            }

            // AJAX Examples
            function ajaxSuccess() {
                const data = document.getElementById('ajax-data').value;

                // Simulate AJAX success
                setTimeout(() => {
                    withModalAlert(function(modal) {
                        modal.success(
                            'AJAX Berhasil!',
                            `Data "${data}" berhasil dikirim ke server.`
                        );
                    });
                }, 1000);
            }

            function ajaxError() {
                // Simulate AJAX error
                setTimeout(() => {
                    withModalAlert(function(modal) {
                        modal.error(
                            'AJAX Gagal!',
                            'Server mengembalikan error 500. Silakan coba lagi.'
                        );
                    });
                }, 1000);
            }

            // Custom Modal Examples
            function showCustomModal() {
                withModalAlert(function(modal) {
                    modal.show({
                        type: 'info',
                        title: 'Modal Custom',
                        message: 'Ini adalah contoh modal dengan konfigurasi lengkap dan multiple callback.',
                        primaryButton: 'Lanjutkan',
                        secondaryButton: 'Batal',
                        primaryAction: function() {
                            modal.success('Berhasil!', 'Anda memilih untuk melanjutkan.');
                        },
                        secondaryAction: function() {
                            modal.warning('Dibatalkan', 'Anda memilih untuk membatalkan.');
                        },
                        onClose: function() {
                            console.log('Modal ditutup');
                        }
                    });
                });
            }

            function showDeleteConfirm() {
                withModalAlert(function(modal) {
                    modal.show({
                        type: 'warning',
                        title: 'Konfirmasi Hapus Data',
                        message: 'Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin?',
                        primaryButton: 'Ya, Hapus',
                        secondaryButton: 'Batal',
                        primaryAction: function() {
                            // Simulate delete process
                            setTimeout(() => {
                                modal.success('Terhapus!', 'Data berhasil dihapus dari sistem.');
                            }, 1500);
                        }
                    });
                });
            }

            function showLogoutConfirm() {
                withModalAlert(function(modal) {
                    modal.show({
                        type: 'warning',
                        title: 'Konfirmasi Logout',
                        message: 'Anda akan keluar dari sistem. Pastikan semua pekerjaan sudah disimpan.',
                        primaryButton: 'Ya, Logout',
                        secondaryButton: 'Batal',
                        primaryAction: function() {
                            modal.info('Logout...', 'Anda akan diarahkan ke halaman login.');
                            // In real app: window.location.href = '/logout';
                        }
                    });
                });
            }

            function showPaymentSuccess() {
                withModalAlert(function(modal) {
                    modal.show({
                        type: 'success',
                        title: 'Pembayaran Berhasil!',
                        message: 'Pembayaran Anda sebesar Rp 250.000 telah berhasil diproses. Invoice telah dikirim ke email.',
                        primaryButton: 'Lihat Invoice',
                        secondaryButton: 'Ke Dashboard',
                        primaryAction: function() {
                            modal.info('Invoice', 'Fitur lihat invoice akan segera tersedia.');
                            // In real app: window.open('/invoice/123', '_blank');
                        },
                        secondaryAction: function() {
                            modal.info('Dashboard', 'Mengarahkan ke dashboard...');
                            // In real app: window.location.href = '/dashboard';
                        }
                    });
                });
            }
        </script>
    @endpush
</x-app>

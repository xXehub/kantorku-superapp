/**
 * Modal Alert Helper
 * Kompatibel dengan Tabler UI Framework
 */

class ModalAlert {
    constructor() {
        this.modalElement = document.getElementById('alertModal');
        
        // Cek apakah modal element ada
        if (!this.modalElement) {
            console.error('Modal element with id "alertModal" not found');
            return;
        }
        
        // Inisialisasi modal - Tabler menggunakan Bootstrap 5
        // Cek berbagai kemungkinan objek modal yang tersedia
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            this.modal = new bootstrap.Modal(this.modalElement);
        } else if (typeof window.bootstrap !== 'undefined' && window.bootstrap.Modal) {
            this.modal = new window.bootstrap.Modal(this.modalElement);
        } else if (typeof $ !== 'undefined' && $.fn.modal) {
            // Fallback untuk jQuery Bootstrap modal
            this.modal = {
                show: () => $(this.modalElement).modal('show'),
                hide: () => $(this.modalElement).modal('hide')
            };
        } else {
            // Manual modal control jika tidak ada library modal
            this.modal = this.createManualModal();
        }
        
        // Konfigurasi ikon untuk setiap tipe
        this.iconConfigs = {
            success: {
                statusClass: 'bg-success',
                iconClass: 'text-green',
                buttonClass: 'btn-success',
                icon: '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 12l2 2l4 -4"></path>'
            },
            error: {
                statusClass: 'bg-danger',
                iconClass: 'text-red',
                buttonClass: 'btn-danger',
                icon: '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path>'
            },
            warning: {
                statusClass: 'bg-warning',
                iconClass: 'text-yellow',
                buttonClass: 'btn-warning',
                icon: '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path>'
            },
            info: {
                statusClass: 'bg-info',
                iconClass: 'text-blue',
                buttonClass: 'btn-info',
                icon: '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 8h.01"></path><path d="M11 12h1v4h1"></path>'
            }
        };
    }
    
    createManualModal() {
        return {
            show: () => {
                this.modalElement.style.display = 'block';
                this.modalElement.classList.add('show');
                document.body.classList.add('modal-open');
                
                // Tambahkan backdrop
                if (!document.querySelector('.modal-backdrop')) {
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.addEventListener('click', () => this.modal.hide());
                    document.body.appendChild(backdrop);
                }
            },
            hide: () => {
                this.modalElement.style.display = 'none';
                this.modalElement.classList.remove('show');
                document.body.classList.remove('modal-open');
                
                // Hapus backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            }
        };
    }

    /**
     * Menampilkan modal alert
     * @param {Object} options - Konfigurasi modal
     * @param {string} options.type - Tipe alert (success, error, warning, info)
     * @param {string} options.title - Judul modal
     * @param {string} options.message - Pesan modal
     * @param {string} options.primaryButton - Text tombol utama
     * @param {string} options.secondaryButton - Text tombol sekunder (opsional)
     * @param {function} options.onPrimary - Callback tombol utama
     * @param {function} options.onSecondary - Callback tombol sekunder
     * @param {function} options.onClose - Callback saat modal ditutup
     */
    show(options) {
        const {
            type = 'success',
            title = 'Notifikasi',
            message = '',
            primaryButton = 'OK',
            secondaryButton = null,
            onPrimary = null,
            onSecondary = null,
            onClose = null
        } = options;

        const config = this.iconConfigs[type] || this.iconConfigs['success'];

        // Update modal status
        const modalStatus = this.modalElement.querySelector('.modal-status');
        if (modalStatus) {
            modalStatus.className = `modal-status ${config.statusClass}`;
        }

        // Update icon SVG
        const iconElement = this.modalElement.querySelector('.modal-body svg.icon');
        if (iconElement) {
            // Update icon class untuk warna
            iconElement.setAttribute('class', `icon mb-2 ${config.iconClass} icon-lg`);
            
            // Update SVG path content
            iconElement.innerHTML = config.icon;
        }

        // Update title
        const titleElement = this.modalElement.querySelector('.modal-body h3');
        if (titleElement) {
            titleElement.textContent = title;
        }

        // Update message
        const messageElement = this.modalElement.querySelector('.modal-body .text-secondary');
        if (messageElement) {
            messageElement.textContent = message;
        }

        // Update buttons
        this.updateButtons(config, primaryButton, secondaryButton, onPrimary, onSecondary);

        // Set callback untuk onClose
        if (onClose) {
            // Event listener yang kompatibel dengan berbagai implementasi modal
            const handleModalHidden = () => {
                onClose();
                this.modalElement.removeEventListener('hidden.bs.modal', handleModalHidden);
                $(this.modalElement).off('hidden.bs.modal', handleModalHidden);
            };
            
            if (typeof bootstrap !== 'undefined') {
                this.modalElement.addEventListener('hidden.bs.modal', handleModalHidden);
            } else if (typeof $ !== 'undefined') {
                $(this.modalElement).on('hidden.bs.modal', handleModalHidden);
            }
        }

        // Tampilkan modal
        this.modal.show();
    }

    /**
     * Update tombol-tombol modal
     */
    updateButtons(config, primaryButton, secondaryButton, onPrimary, onSecondary) {
        // Cari modal footer, jika tidak ada buat yang baru
        let modalFooter = this.modalElement.querySelector('.modal-footer');
        if (!modalFooter) {
            modalFooter = document.createElement('div');
            modalFooter.className = 'modal-footer';
            this.modalElement.querySelector('.modal-content').appendChild(modalFooter);
        }
        
        // Cari atau buat row container untuk buttons
        let footer = modalFooter.querySelector('.row');
        if (!footer) {
            footer = document.createElement('div');
            footer.className = 'row';
            modalFooter.appendChild(footer);
        }
        
        // Hapus event listeners yang lama
        const oldButtons = footer.querySelectorAll('button');
        oldButtons.forEach(btn => {
            if (btn._clickHandler) {
                btn.removeEventListener('click', btn._clickHandler);
            }
        });
        
        if (secondaryButton) {
            footer.innerHTML = `
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary w-100" id="secondaryBtn">
                        ${secondaryButton}
                    </button>
                </div>
                <div class="col">
                    <button type="button" class="btn ${config.buttonClass} w-100" id="primaryBtn">
                        ${primaryButton}
                    </button>
                </div>
            `;
            
            // Set event listeners dengan referensi yang bisa dihapus nanti
            const secondaryBtn = footer.querySelector('#secondaryBtn');
            const primaryBtn = footer.querySelector('#primaryBtn');
            
            if (secondaryBtn) {
                const secondaryHandler = () => {
                    // Tutup modal dulu, baru jalankan callback setelah modal tertutup
                    if (onSecondary) {
                        this.hideAndExecute(onSecondary);
                    } else {
                        this.modal.hide();
                    }
                };
                secondaryBtn._clickHandler = secondaryHandler;
                secondaryBtn.addEventListener('click', secondaryHandler);
            }
            
            if (primaryBtn) {
                const primaryHandler = () => {
                    // Tutup modal dulu, baru jalankan callback setelah modal tertutup
                    if (onPrimary) {
                        this.hideAndExecute(onPrimary);
                    } else {
                        this.modal.hide();
                    }
                };
                primaryBtn._clickHandler = primaryHandler;
                primaryBtn.addEventListener('click', primaryHandler);
            }
        } else {
            footer.innerHTML = `
                <div class="col">
                    <button type="button" class="btn ${config.buttonClass} w-100" id="primaryBtn">
                        ${primaryButton}
                    </button>
                </div>
            `;
            
            const primaryBtn = footer.querySelector('#primaryBtn');
            if (primaryBtn) {
                const primaryHandler = () => {
                    // Tutup modal dulu, baru jalankan callback setelah modal tertutup
                    if (onPrimary) {
                        this.hideAndExecute(onPrimary);
                    } else {
                        this.modal.hide();
                    }
                };
                primaryBtn._clickHandler = primaryHandler;
                primaryBtn.addEventListener('click', primaryHandler);
            }
        }
    }

    /**
     * Shortcut methods untuk tipe-tipe umum
     */
    success(title, message, onConfirm = null) {
        this.show({
            type: 'success',
            title: title,
            message: message,
            primaryButton: 'OK',
            onPrimary: onConfirm
        });
    }

    error(title, message, onConfirm = null) {
        this.show({
            type: 'error',
            title: title,
            message: message,
            primaryButton: 'OK',
            onPrimary: onConfirm
        });
    }

    warning(title, message, onConfirm = null) {
        this.show({
            type: 'warning',
            title: title,
            message: message,
            primaryButton: 'OK',
            onPrimary: onConfirm
        });
    }

    info(title, message, onConfirm = null) {
        this.show({
            type: 'info',
            title: title,
            message: message,
            primaryButton: 'OK',
            onPrimary: onConfirm
        });
    }

    /**
     * Konfirmasi dengan dua tombol
     */
    confirm(title, message, onConfirm, onCancel = null) {
        this.show({
            type: 'warning',
            title: title,
            message: message,
            primaryButton: 'Ya',
            secondaryButton: 'Batal',
            onPrimary: onConfirm,
            onSecondary: onCancel
        });
    }

    /**
     * Tutup modal dengan aman dan jalankan callback setelah modal tertutup
     */
    hideAndExecute(callback) {
        if (!callback) {
            this.modal.hide();
            return;
        }

        // Setup event listener untuk menangkap ketika modal sudah benar-benar tertutup
        const handleHidden = () => {
            // Hapus event listener
            this.modalElement.removeEventListener('hidden.bs.modal', handleHidden);
            if (typeof $ !== 'undefined') {
                $(this.modalElement).off('hidden.bs.modal', handleHidden);
            }
            
            // Jalankan callback setelah modal tertutup
            setTimeout(() => {
                try {
                    callback();
                } catch (error) {
                    console.error('Error executing callback after modal hide:', error);
                }
            }, 100); // Small delay untuk memastikan modal benar-benar hilang
        };

        // Daftarkan event listener
        if (typeof bootstrap !== 'undefined') {
            this.modalElement.addEventListener('hidden.bs.modal', handleHidden);
        } else if (typeof $ !== 'undefined') {
            $(this.modalElement).on('hidden.bs.modal', handleHidden);
        } else {
            // Fallback jika tidak ada event system
            setTimeout(handleHidden, 300);
        }

        // Tutup modal
        this.modal.hide();
    }

    /**
     * Menutup modal
     */
    hide() {
        this.modal.hide();
    }
}

// Inisialisasi global
let modalAlert;

// Inisialisasi setelah DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Tunggu sampai semua script Tabler/Bootstrap dimuat
    function initializeModalAlert() {
        try {
            modalAlert = new ModalAlert();
            
            // Export ke window object agar bisa diakses global
            window.modalAlert = modalAlert;
            
            console.log('ModalAlert initialized successfully');
        } catch (error) {
            console.error('Failed to initialize ModalAlert:', error);
            
            // Fallback sederhana jika modal alert gagal diinisialisasi
            window.modalAlert = {
                success: (title, message) => alert(`SUCCESS: ${title}\n${message}`),
                error: (title, message) => alert(`ERROR: ${title}\n${message}`),
                warning: (title, message) => alert(`WARNING: ${title}\n${message}`),
                info: (title, message) => alert(`INFO: ${title}\n${message}`),
                show: (options) => alert(`${options.title}\n${options.message}`),
                confirm: (title, message, onConfirm) => {
                    if (confirm(`${title}\n${message}`)) {
                        if (onConfirm) onConfirm();
                    }
                }
            };
        }
    }
    
    // Coba inisialisasi langsung
    initializeModalAlert();
    
    // Jika gagal, coba lagi setelah delay singkat
    if (!window.modalAlert || typeof window.modalAlert.show !== 'function') {
        setTimeout(initializeModalAlert, 500);
    }
});

// Backward compatibility - fungsi-fungsi helper
window.showSuccess = function(title, message, onConfirm) {
    if (window.modalAlert && typeof window.modalAlert.success === 'function') {
        window.modalAlert.success(title, message, onConfirm);
    } else {
        alert(`SUCCESS: ${title}\n${message}`);
        if (onConfirm) onConfirm();
    }
};

window.showError = function(title, message, onConfirm) {
    if (window.modalAlert && typeof window.modalAlert.error === 'function') {
        window.modalAlert.error(title, message, onConfirm);
    } else {
        alert(`ERROR: ${title}\n${message}`);
        if (onConfirm) onConfirm();
    }
};

window.showWarning = function(title, message, onConfirm) {
    if (window.modalAlert && typeof window.modalAlert.warning === 'function') {
        window.modalAlert.warning(title, message, onConfirm);
    } else {
        alert(`WARNING: ${title}\n${message}`);
        if (onConfirm) onConfirm();
    }
};

window.showInfo = function(title, message, onConfirm) {
    if (window.modalAlert && typeof window.modalAlert.info === 'function') {
        window.modalAlert.info(title, message, onConfirm);
    } else {
        alert(`INFO: ${title}\n${message}`);
        if (onConfirm) onConfirm();
    }
};

window.showConfirm = function(title, message, onConfirm, onCancel) {
    if (window.modalAlert && typeof window.modalAlert.confirm === 'function') {
        window.modalAlert.confirm(title, message, onConfirm, onCancel);
    } else {
        if (confirm(`${title}\n${message}`)) {
            if (onConfirm) onConfirm();
        } else {
            if (onCancel) onCancel();
        }
    }
};

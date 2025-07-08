<script>
// Fungsi utama untuk konfirmasi logout
function confirmLogout() {
    console.log('Konfirmasi logout dipanggil');

    // Coba gunakan modal alert jika tersedia
    if (typeof window.modalAlert !== 'undefined' && window.modalAlert) {
        window.modalAlert.show({
            type: 'warning',
            title: 'Konfirmasi Logout',
            message: 'Apakah Anda yakin ingin keluar dari sistem?',
            primaryButton: 'Ya, Logout',
            secondaryButton: 'Batal',
            onPrimary: function() {
                submitLogoutForm();
            }
        });
    } else {
        // Fallback ke browser confirm
        if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
            submitLogoutForm();
        }
    }
}

// Fungsi untuk submit form logout
function submitLogoutForm() {
    const logoutForm = document.getElementById('logout-form');
    if (logoutForm) {
        console.log('Submit form logout');
        logoutForm.submit();
    } else {
        console.error('Form logout tidak ditemukan!');
        // Fallback redirect manual
        window.location.href = '{{ route('logout') }}';
    }
}

// Debug: Cek form logout saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.getElementById('logout-form');
    if (!logoutForm) {
        console.error('Form logout tidak ditemukan saat halaman dimuat!');
    }
});
</script>

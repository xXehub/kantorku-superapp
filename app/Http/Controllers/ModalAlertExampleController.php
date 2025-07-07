<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ModalAlert;

class ModalAlertExampleController extends Controller
{
    /**
     * Halaman contoh penggunaan modal alert
     */
    public function index()
    {
        return view('examples.modal-alert');
    }

    /**
     * Contoh success alert
     */
    public function success()
    {
        ModalAlert::success(
            'Operasi Berhasil!',
            'Data telah berhasil disimpan ke database.'
        );

        return redirect()->back();
    }

    /**
     * Contoh error alert
     */
    public function error()
    {
        ModalAlert::error(
            'Terjadi Kesalahan!',
            'Gagal menyimpan data. Silakan periksa koneksi internet Anda.',
            'Coba Lagi'
        );

        return redirect()->back();
    }

    /**
     * Contoh warning alert
     */
    public function warning()
    {
        ModalAlert::warning(
            'Peringatan Sistem!',
            'Sistem akan melakukan maintenance dalam 30 menit. Simpan pekerjaan Anda.',
            'Mengerti'
        );

        return redirect()->back();
    }

    /**
     * Contoh info alert
     */
    public function info()
    {
        ModalAlert::info(
            'Informasi Terbaru',
            'Fitur baru telah ditambahkan ke sistem. Lihat panduan penggunaan di menu Help.',
            'Lihat Panduan'
        );

        return redirect()->back();
    }

    /**
     * Contoh confirmation alert
     */
    public function confirmation()
    {
        ModalAlert::confirm(
            'Konfirmasi Tindakan',
            'Apakah Anda yakin ingin melanjutkan operasi ini? Tindakan ini akan mengubah data secara permanen.',
            'Ya, Lanjutkan',
            'Batal',
            'performAction()',
            'cancelAction()'
        );

        return redirect()->back();
    }

    /**
     * Simulasi form submission dengan validation
     */
    public function submitForm(Request $request)
    {
        // Simulasi validasi
        if (!$request->filled('name')) {
            ModalAlert::warning(
                'Data Tidak Lengkap',
                'Nama harus diisi untuk melanjutkan.'
            );
            return redirect()->back();
        }

        if (!$request->filled('email')) {
            ModalAlert::warning(
                'Data Tidak Lengkap',
                'Email harus diisi untuk melanjutkan.'
            );
            return redirect()->back();
        }

        // Simulasi proses penyimpanan
        if ($request->email === 'error@test.com') {
            ModalAlert::error(
                'Gagal Menyimpan!',
                'Email tersebut sudah terdaftar dalam sistem.'
            );
            return redirect()->back();
        }

        // Sukses
        ModalAlert::success(
            'Data Berhasil Disimpan!',
            'Pengguna baru telah berhasil ditambahkan ke sistem.'
        );

        return redirect()->back();
    }

    /**
     * Contoh bulk action dengan confirmation
     */
    public function bulkDelete(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);

        if (empty($selectedIds)) {
            ModalAlert::warning(
                'Tidak Ada Data Dipilih',
                'Pilih minimal satu data untuk dihapus.'
            );
            return redirect()->back();
        }

        ModalAlert::confirm(
            'Konfirmasi Hapus Massal',
            'Anda akan menghapus ' . count($selectedIds) . ' data. Tindakan ini tidak dapat dibatalkan.',
            'Ya, Hapus Semua',
            'Batal',
            'confirmBulkDelete(' . json_encode($selectedIds) . ')',
            null
        );

        return redirect()->back();
    }

    /**
     * Konfirmasi bulk delete
     */
    public function confirmBulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        try {
            // Simulasi penghapusan data
            // Model::whereIn('id', $ids)->delete();

            ModalAlert::success(
                'Data Berhasil Dihapus!',
                count($ids) . ' data telah berhasil dihapus dari sistem.'
            );

        } catch (\Exception $e) {
            ModalAlert::error(
                'Gagal Menghapus Data!',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }

        return redirect()->back();
    }
}

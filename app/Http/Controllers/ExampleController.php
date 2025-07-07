<?php

namespace App\Http\Controllers;

use App\Helpers\ModalAlert;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Contoh penggunaan modal alert untuk berbagai skenario
     */

    public function showExamples()
    {
        return view('examples.modal-alert');
    }

    /**
     * Contoh success alert
     */
    public function successExample()
    {
        ModalAlert::success(
            'Berhasil!',
            'Data telah berhasil disimpan ke database.'
        );

        return redirect()->back();
    }

    /**
     * Contoh error alert
     */
    public function errorExample()
    {
        ModalAlert::error(
            'Terjadi Kesalahan!',
            'Koneksi ke database gagal. Silakan coba lagi nanti.'
        );

        return redirect()->back();
    }

    /**
     * Contoh warning alert
     */
    public function warningExample()
    {
        ModalAlert::warning(
            'Peringatan!',
            'Anda akan menghapus data yang tidak dapat dikembalikan. Pastikan Anda yakin.'
        );

        return redirect()->back();
    }

    /**
     * Contoh info alert
     */
    public function infoExample()
    {
        ModalAlert::info(
            'Informasi Penting',
            'Sistem akan maintenance pada hari Minggu pukul 02:00 - 06:00 WIB.'
        );

        return redirect()->back();
    }

    /**
     * Contoh dengan custom button dan action
     */
    public function customExample()
    {
        ModalAlert::success(
            'Pembayaran Berhasil!',
            'Invoice telah dikirim ke email Anda.',
            'Lihat Invoice',
            'window.open("/invoice/123", "_blank")'
        );

        return redirect()->back();
    }

    /**
     * Simulasi operasi dengan validasi
     */
    public function validateExample(Request $request)
    {
        $name = $request->input('name');

        if (empty($name)) {
            ModalAlert::warning(
                'Validasi Gagal',
                'Nama tidak boleh kosong. Harap isi semua field yang wajib.'
            );
            return redirect()->back();
        }

        if (strlen($name) < 3) {
            ModalAlert::warning(
                'Nama Terlalu Pendek',
                'Nama harus minimal 3 karakter.'
            );
            return redirect()->back();
        }

        // Simulasi sukses
        ModalAlert::success(
            'Validasi Berhasil!',
            "Halo {$name}, data Anda valid dan telah disimpan."
        );

        return redirect()->back();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterApp;
use App\Models\Instansi;

class MasterAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            // Aplikasi Dinas Pendidikan
            [
                'kode_app' => 'SIAKAD',
                'nama_app' => 'SIAKAD Online',
                'deskripsi_app' => 'Sistem Informasi Akademik',
                'url_app' => 'https://siakad.disdik.surabaya.go.id',
                'kode_instansi' => 'DISDIK',
            ],
            [
                'kode_app' => 'ELEARN',
                'nama_app' => 'E-Learning Portal',
                'deskripsi_app' => 'Platform pembelajaran online',
                'url_app' => 'https://elearning.disdik.surabaya.go.id',
                'kode_instansi' => 'DISDIK',
            ],
            // Aplikasi Dinas Kesehatan
            [
                'kode_app' => 'SIMRS',
                'nama_app' => 'SIMRS Puskesmas',
                'deskripsi_app' => 'Sistem Informasi Manajemen Rumah Sakit',
                'url_app' => 'https://simrs.dinkes.surabaya.go.id',
                'kode_instansi' => 'DINKES',
            ],
            [
                'kode_app' => 'EHR',
                'nama_app' => 'E-Health Record',
                'deskripsi_app' => 'Sistem rekam medis elektronik',
                'url_app' => 'https://ehr.dinkes.surabaya.go.id',
                'kode_instansi' => 'DINKES',
            ],
            // Aplikasi Dinas Sosial
            [
                'kode_app' => 'SIKS',
                'nama_app' => 'SIKS Bantuan Sosial',
                'deskripsi_app' => 'Sistem Informasi Kesejahteraan Sosial',
                'url_app' => 'https://siks.dinsos.surabaya.go.id',
                'kode_instansi' => 'DINSOS',
            ],
            // Aplikasi DPU
            [
                'kode_app' => 'SIMPEG',
                'nama_app' => 'SIMPEG DPU',
                'deskripsi_app' => 'Sistem Informasi Kepegawaian',
                'url_app' => 'https://simpeg.dpu.surabaya.go.id',
                'kode_instansi' => 'DPU',
            ],
            [
                'kode_app' => 'INFRA',
                'nama_app' => 'Infrastruktur Monitoring',
                'deskripsi_app' => 'Sistem monitoring infrastruktur',
                'url_app' => 'https://monitoring.dpu.surabaya.go.id',
                'kode_instansi' => 'DPU',
            ],
            // Aplikasi Setda
            [
                'kode_app' => 'EOFFICE',
                'nama_app' => 'E-Office Setda',
                'deskripsi_app' => 'Sistem administrasi perkantoran',
                'url_app' => 'https://eoffice.setda.surabaya.go.id',
                'kode_instansi' => 'SETDA',
            ],
        ];

        foreach ($apps as $appData) {
            // Cari instansi berdasarkan kode
            $instansi = Instansi::where('kode_instansi', $appData['kode_instansi'])->first();
            
            if ($instansi) {
                MasterApp::firstOrCreate(
                    ['kode_app' => $appData['kode_app']],
                    [
                        'kode_app' => $appData['kode_app'],
                        'nama_app' => $appData['nama_app'],
                        'deskripsi_app' => $appData['deskripsi_app'],
                        'url_app' => $appData['url_app'],
                        'logo_app' => null,
                        'is_active' => true,
                        'created_by' => 1, // Superadmin
                        'instansi_id' => $instansi->id,
                    ]
                );
            }
        }
    }
}

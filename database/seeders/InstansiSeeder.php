<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instansi;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instansi = [
            [
                'kode_instansi' => 'DISDIK',
                'nama_instansi' => 'Dinas Pendidikan Kota Surabaya',
                'alamat' => 'Jl. Jagir Wonokromo No. 354, Surabaya',
                'kontak' => '(031) 8292945',
                'email' => 'disdik@surabaya.go.id',
                'website' => 'https://disdik.surabaya.go.id',
                'deskripsi' => 'Dinas Pendidikan bertanggung jawab dalam penyelenggaraan pendidikan di Kota Surabaya',
                'is_active' => true,
            ],
            [
                'kode_instansi' => 'DINKES',
                'nama_instansi' => 'Dinas Kesehatan Kota Surabaya',
                'alamat' => 'Jl. Indrapura No. 17, Surabaya',
                'kontak' => '(031) 5031642',
                'email' => 'dinkes@surabaya.go.id',
                'website' => 'https://dinkes.surabaya.go.id',
                'deskripsi' => 'Dinas Kesehatan menyelenggarakan pelayanan kesehatan masyarakat Kota Surabaya',
                'is_active' => true,
            ],
            [
                'kode_instansi' => 'DINSOS',
                'nama_instansi' => 'Dinas Sosial Kota Surabaya',
                'alamat' => 'Jl. Jimerto No. 25-27, Surabaya',
                'kontak' => '(031) 5345614',
                'email' => 'dinsos@surabaya.go.id',
                'website' => 'https://dinsos.surabaya.go.id',
                'deskripsi' => 'Dinas Sosial menangani berbagai program kesejahteraan sosial masyarakat',
                'is_active' => true,
            ],
            [
                'kode_instansi' => 'DPU',
                'nama_instansi' => 'Dinas Pekerjaan Umum Kota Surabaya',
                'alamat' => 'Jl. Raya Kendangsari No. 9, Surabaya',
                'kontak' => '(031) 8715543',
                'email' => 'dpu@surabaya.go.id',
                'website' => 'https://dpu.surabaya.go.id',
                'deskripsi' => 'Dinas Pekerjaan Umum menangani infrastruktur dan bangunan publik',
                'is_active' => true,
            ],
            [
                'kode_instansi' => 'SETDA',
                'nama_instansi' => 'Sekretariat Daerah Kota Surabaya',
                'alamat' => 'Jl. Taman Surya No. 1, Surabaya',
                'kontak' => '(031) 5633142',
                'email' => 'setda@surabaya.go.id',
                'website' => 'https://surabaya.go.id',
                'deskripsi' => 'Sekretariat Daerah sebagai koordinator administrasi pemerintahan',
                'is_active' => true,
            ],
        ];

        foreach ($instansi as $inst) {
            Instansi::firstOrCreate(
                ['kode_instansi' => $inst['kode_instansi']],
                $inst
            );
        }
    }
}

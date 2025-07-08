<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriApp;

class KategoriAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'Aplikasi dan layanan terkait kesehatan masyarakat',
                'icon' => 'heart-plus',
                'color' => '#dc3545',
                'sort_order' => 1,
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Aplikasi dan layanan pendidikan',
                'icon' => 'book',
                'color' => '#0d6efd',
                'sort_order' => 2,
            ],
            [
                'nama_kategori' => 'Pariwisata',
                'slug' => 'pariwisata',
                'deskripsi' => 'Aplikasi dan layanan pariwisata',
                'icon' => 'map-pin',
                'color' => '#198754',
                'sort_order' => 3,
            ],
            [
                'nama_kategori' => 'Perizinan',
                'slug' => 'perizinan',
                'deskripsi' => 'Aplikasi dan layanan perizinan',
                'icon' => 'file-text',
                'color' => '#fd7e14',
                'sort_order' => 4,
            ],
            [
                'nama_kategori' => 'Ekonomi',
                'slug' => 'ekonomi',
                'deskripsi' => 'Aplikasi dan layanan ekonomi dan perdagangan',
                'icon' => 'currency-dollar',
                'color' => '#6f42c1',
                'sort_order' => 5,
            ],
            [
                'nama_kategori' => 'Sosial',
                'slug' => 'sosial',
                'deskripsi' => 'Aplikasi dan layanan sosial kemasyarakatan',
                'icon' => 'users',
                'color' => '#20c997',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            KategoriApp::create($category);
        }
    }
}

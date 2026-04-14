<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Fasilitas',
            'Akademik',
            'Keamanan',
            'Administrasi',
            'Kebersihan',
            'Kesehatan',
            'Transportasi',
            'Kantin',
            'Laboratorium',
            'Perpustakaan',
            'Teknologi Informasi',
            'Parkir',
            'Pembangunan',
            'Ekstrakurikuler',
            'Kurikulum',
            'Kesiswaan',
            'Kepala Sekolah',
            'Karyawan',
            'Pengajaran',
            'Hubungan Orangtua'
        ];

        foreach ($data as $nama) {
            Kategori::create([
                'nama_kategori' => $nama
            ]);
        }
    }
}
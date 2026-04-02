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
            'Administrasi'
        ];

        foreach ($data as $nama) {
            Kategori::create([
                'nama_kategori' => $nama
            ]);
        }
    }
}

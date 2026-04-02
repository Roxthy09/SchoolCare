<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Kategori;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = User::where('peran', 'orangtua')->first();
        $kategori = Kategori::first();

        Pengaduan::create([
            'user_id' => $siswa->user_id,
            'kategori_id' => $kategori->kategori_id,
            'judul' => 'Kipas kelas rusak',
            'deskripsi' => 'Kipas angin di kelas 9A tidak berfungsi',
            'status' => 'tertunda',
            'tanggal_dibuat' => now()
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatStatus;
use App\Models\Pengaduan;
use App\Models\User;

class RiwayatStatusSeeder extends Seeder
{
    public function run(): void
    {
        $pengaduan = Pengaduan::first();
        $admin = User::where('peran', 'admin')->first();

        RiwayatStatus::create([
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status' => 'dalam_proses',
            'tanggal_ubah' => now(),
            'diubah_oleh' => $admin->user_id
        ]);
    }
}

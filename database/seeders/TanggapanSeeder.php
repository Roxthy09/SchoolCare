<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\User;

class TanggapanSeeder extends Seeder
{
    public function run(): void
    {
        $pengaduan = Pengaduan::first();
        $admin = User::where('peran', 'admin')->first();

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'user_id' => $admin->user_id,
            'teks_tanggapan' => 'Terima kasih atas laporannya, akan segera kami tindak lanjuti.',
            'tanggal_tanggapan' => now()
        ]);
    }
}

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
        $orangtuaIds = User::where('peran', 'orangtua')->pluck('user_id')->toArray();
        $kategoriIds = Kategori::pluck('kategori_id')->toArray();

        if (empty($orangtuaIds) || empty($kategoriIds)) {
            return;
        }

        $judulList = [
            'Kipas kelas rusak',
            'Lampu koridor mati',
            'Pintu kelas tidak bisa dikunci',
            'AC ruangan laboratorium bocor',
            'Kursi siswa retak',
            'Toilet siswa kotor',
            'Air minum tidak tersedia',
            'Wi-Fi sekolah sering putus',
            'Pagar sekolah rusak',
            'Perpus kekurangan buku',
            'Kantin sering kehabisan makanan',
            'Jalan masuk berlubang',
            'Kamera CCTV tidak berfungsi',
            'Atap ruang kelas bocor',
            'Lantai kelas licin',
            'Suara bising dari pengeras suara',
            'Tempat sampah penuh',
            'Meja guru rusak',
            'Taman sekolah tidak terawat',
            'Jam istirahat dipersingkat'
        ];

        $deskripsiList = [
            'Kipas angin di kelas 9A tidak berfungsi dan membuat suasana belajar panas.',
            'Beberapa lampu di koridor lantai 2 sudah padam sejak seminggu lalu.',
            'Pintu kelas 10B tidak bisa dikunci dengan kunci yang ada.',
            'AC di ruang laboratorium biologi bocor dan memicu genangan air.',
            'Beberapa kursi siswa di kelas 8C retak dan berbahaya.',
            'Kamar mandi siswa sering tidak dibersihkan dan bau tidak sedap.',
            'Dispenser air minum di area umum sering kosong dan tidak diisi kembali.',
            'Koneksi Wi-Fi sekolah sering terputus saat jam pelajaran berlangsung.',
            'Pagar belakang sekolah banyak yang rusak dan berpotensi membahayakan.',
            'Perpustakaan kekurangan buku pelajaran untuk kelas XI dan XII.',
            'Kantin sering kehabisan makanan saat jam istirahat pertama.',
            'Jalan masuk utama menuju sekolah berlubang dan susah dilalui motor.',
            'Beberapa kamera CCTV di lapangan tidak berfungsi lagi.',
            'Atap ruang kelas 7A bocor saat hujan deras tiba-tiba.',
            'Lantai kelas baru sangat licin dan rawan siswa terpeleset.',
            'Pengeras suara untuk pengumuman sering mengeluarkan suara bising.',
            'Tempat sampah di halaman sering penuh dan tidak segera dikosongkan.',
            'Meja guru di ruang guru kondisi rusak dan goyah.',
            'Taman sekolah tidak terawat, banyak tanaman mati dan rumput panjang.',
            'Jam istirahat dikurangi tanpa pemberitahuan, membuat siswa kurang istirahat.'
        ];

        $statusOptions = ['tertunda', 'dalam_proses', 'selesai', 'dibatalkan'];

        foreach (range(0, 19) as $index) {
            Pengaduan::create([
                'user_id' => $orangtuaIds[array_rand($orangtuaIds)],
                'kategori_id' => $kategoriIds[array_rand($kategoriIds)],
                'judul' => $judulList[$index],
                'deskripsi' => $deskripsiList[$index],
                'status' => $statusOptions[array_rand($statusOptions)],
                'tanggal_dibuat' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
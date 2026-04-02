<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ======================
        // USER (SISWA / ORANGTUA)
        // ======================
        if (in_array($user->peran, ['siswa', 'orangtua'])) {

            $totalPengaduan   = Pengaduan::where('user_id', $user->user_id)->count();
            $pengaduanProses  = Pengaduan::where('user_id', $user->user_id)
                                        ->where('status', 'dalam_proses')
                                        ->count();
            $pengaduanSelesai = Pengaduan::where('user_id', $user->user_id)
                                        ->where('status', 'selesai')
                                        ->count();

            return view('profile.user', compact(
                'user',
                'totalPengaduan',
                'pengaduanProses',
                'pengaduanSelesai'
            ));
        }

        // ======================
        // ADMIN & PETUGAS
        // ======================
        if (in_array($user->peran, ['admin', 'petugas'])) {

            $totalPengaduan   = Pengaduan::count();
            $pengaduanMasuk   = Pengaduan::where('status', 'menunggu')->count();
            $pengaduanProses  = Pengaduan::where('status', 'dalam_proses')->count();
            $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();

            return view('profile.admin', compact(
                'user',
                'totalPengaduan',
                'pengaduanMasuk',
                'pengaduanProses',
                'pengaduanSelesai'
            ));
        }

        abort(403, 'Role tidak dikenali');
    }
}

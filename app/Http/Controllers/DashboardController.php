<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /* ================= ADMIN ================= */
        if ($user->peran === 'admin') {

            // ✅ Cache 60 detik biar super cepat
            $stats = Cache::remember('dashboard_admin_stats', 60, function () {
                return Pengaduan::withTrashed()
                    ->selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');
            });

            $totalPengaduan    = $stats->sum();
            $pengaduanSelesai  = $stats['selesai'] ?? 0;
            $pengaduanProses   = $stats['dalam_proses'] ?? 0;
            $pengaduanTertunda = $stats['tertunda'] ?? 0;

            $totalUsers = Cache::remember('total_users', 60, function () {
                return User::count();
            });

            $chartKategori = Cache::remember('chart_kategori', 60, function () {
                return Pengaduan::join('kategoris', 'pengaduans.kategori_id', '=', 'kategoris.kategori_id')
                    ->selectRaw('kategoris.nama_kategori as kategori, COUNT(*) as total')
                    ->groupBy('kategoris.nama_kategori')
                    ->orderByDesc('total')
                    ->pluck('total', 'kategori')
                    ->toArray();
            });

            return view('dashboard.admin', compact(
                'totalPengaduan',
                'pengaduanSelesai',
                'pengaduanProses',
                'pengaduanTertunda',
                'totalUsers',
                'chartKategori'
            ));
        }

        /* ================= PETUGAS ================= */
        if ($user->peran === 'petugas') {

            $stats = Cache::remember('dashboard_petugas_stats', 60, function () {
                return Pengaduan::withTrashed()
                    ->selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');
            });

            $totalPengaduan   = $stats->sum();
            $pengaduanBaru    = $stats['tertunda'] ?? 0;
            $pengaduanProses  = $stats['dalam_proses'] ?? 0;
            $pengaduanSelesai = $stats['selesai'] ?? 0;

            return view('dashboard.petugas', compact(
                'totalPengaduan',
                'pengaduanBaru',
                'pengaduanProses',
                'pengaduanSelesai'
            ));
        }

        /* ================= ORANGTUA ================= */
        if ($user->peran === 'orangtua') {

            $uid = $user->user_id;

            $stats = Cache::remember("dashboard_orangtua_stats_$uid", 60, function () use ($uid) {
                return Pengaduan::withTrashed()
                    ->where('user_id', $uid)
                    ->selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');
            });

            $totalPengaduan   = $stats->sum();
            $pengaduanBaru    = $stats['tertunda'] ?? 0;
            $pengaduanProses  = $stats['dalam_proses'] ?? 0;
            $pengaduanSelesai = $stats['selesai'] ?? 0;

            // ✅ Ambil 5 data terbaru (ini memang perlu query sendiri)
            $pengaduanTerbaru = Pengaduan::withTrashed()
                ->where('user_id', $uid)
                ->latest('tanggal_dibuat')
                ->limit(5)
                ->get();

            return view('dashboard.orangtua', compact(
                'totalPengaduan',
                'pengaduanBaru',
                'pengaduanProses',
                'pengaduanSelesai',
                'pengaduanTerbaru'
            ));
        }

        abort(403);
    }

    public function indexApi()
{
    $user = Auth::user();
    $uid  = $user->user_id;
 
    $stats = Cache::remember("dashboard_{$user->peran}_stats_$uid", 60, function () use ($user, $uid) {
        $query = Pengaduan::withTrashed();
        if ($user->peran === 'orangtua') {
            $query->where('user_id', $uid);
        }
        return $query->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
    });
 
    $pengaduanTerbaru = [];
    if (in_array($user->peran, ['orangtua'])) {
        $pengaduanTerbaru = Pengaduan::withTrashed()
            ->where('user_id', $uid)
            ->latest('tanggal_dibuat')
            ->limit(5)
            ->get(['judul', 'status', 'tanggal_dibuat', 'kategori_id'])
            ->map(function ($p) {
                return [
                    'judul'         => $p->judul,
                    'status'        => $p->status,         // 'tertunda' | 'dalam_proses' | 'selesai'
                    'tanggal_dibuat'=> $p->tanggal_dibuat->format('d M Y'),
                    'kategori'      => $p->kategori->nama_kategori ?? '',
                ];
            });
    }
 
    return response()->json([
        'user' => [
            'name'  => $user->name,
            'peran' => $user->peran,   // 'admin' | 'petugas' | 'orangtua'
        ],
        'stats' => [
            'total'        => $stats->sum(),
            'dalam_proses' => $stats['dalam_proses'] ?? 0,
            'selesai'      => $stats['selesai']       ?? 0,
            'tertunda'     => $stats['tertunda']      ?? 0,
        ],
        'pengaduan_terbaru' => $pengaduanTerbaru,
    ]);
}
}
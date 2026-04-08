<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $uid  = $user->user_id; // FIX

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

        if ($user->peran === 'orangtua') {
            $pengaduanTerbaru = Pengaduan::with(['kategori']) // FIX
                ->withTrashed()
                ->where('user_id', $uid)
                ->latest('tanggal_dibuat')
                ->limit(5)
                ->get()
                ->map(function ($p) {
                    return [
                        'judul'         => $p->judul,
                        'status'        => $p->status,
                        'tanggal_dibuat' => optional($p->tanggal_dibuat)->format('d M Y'), // AMAN
                        'kategori'      => $p->kategori->nama_kategori ?? '-',
                    ];
                });
        }

        return response()->json([
            'user' => [
                'name'  => $user->name,
                'peran' => $user->peran,
            ],
            'stats' => [
                'total'        => $stats->sum(),
                'dalam_proses' => $stats['dalam_proses'] ?? 0,
                'selesai'      => $stats['selesai'] ?? 0,
                'tertunda'     => $stats['tertunda'] ?? 0,
            ],
            'pengaduan_terbaru' => $pengaduanTerbaru,
        ]);
    }
}

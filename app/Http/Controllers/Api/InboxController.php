<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * GET /api/inbox
     * Daftar thread pengaduan yang memiliki percakapan
     */
    public function index()
    {
        $user = auth()->user();

        $query = Pengaduan::with([
            'kategori',
            'tanggapans' => fn($q) => $q->latest('tanggal_tanggapan')->limit(1),
        ])
            ->withCount('tanggapans')
            ->orderByDesc('tanggal_dibuat'); // ✅ FIX

        // Orangtua hanya lihat miliknya
        if ($user->peran === 'orangtua') {
            $query->where('user_id', $user->user_id);
        }

        // Hanya tampilkan yang punya tanggapan ATAU milik sendiri
        $query->where(function ($q) use ($user) {
            $q->has('tanggapans')
                ->orWhere('user_id', $user->user_id);
        });

        $threads = $query->paginate(15);

        $data = $threads->map(function ($p) use ($user) {
            $lastMsg = $p->tanggapans->first();

            return [
                'pengaduan_id'   => $p->pengaduan_id,
                'judul'          => $p->judul,
                'status'         => $p->status,
                'kategori'       => $p->kategori?->nama_kategori,
                'jumlah_pesan'   => $p->tanggapans_count,
                'pesan_terakhir' => $lastMsg ? [
                    'teks'    => $lastMsg->teks_tanggapan,
                    'waktu'   => $lastMsg->tanggal_tanggapan,
                    'dari_ku' => $lastMsg->user_id === $user->user_id,
                ] : null,
            ];
        });

        return response()->json([
            'data'       => $data,
            'total'      => $threads->total(),
            'halaman'    => $threads->currentPage(),
            'total_halaman' => $threads->lastPage(),
        ]);
    }

    /**
     * GET /api/inbox/{pengaduan_id}
     * Semua pesan dalam satu thread pengaduan
     */
    public function show($pengaduanId)
    {
        $user = auth()->user();

        $pengaduan = Pengaduan::with(['kategori', 'pengguna'])
            ->where('pengaduan_id', $pengaduanId)
            ->firstOrFail();

        // Orangtua hanya boleh akses miliknya
        if ($user->peran === 'orangtua' && $pengaduan->user_id !== $user->user_id) {
            abort(403, 'Anda tidak punya akses ke pengaduan ini.');
        }

        $pesan = Tanggapan::with('pengguna')
            ->where('pengaduan_id', $pengaduanId)
            ->orderBy('tanggal_tanggapan')
            ->get()
            ->map(function ($t) use ($user) {
                return [
                    'tanggapan_id'   => $t->tanggapan_id,
                    'teks'           => $t->teks_tanggapan,
                    'waktu'          => $t->tanggal_tanggapan,
                    'dari_ku'        => $t->user_id === $user->user_id,
                    'pengirim_nama'  => $t->pengguna?->name,
                    'pengirim_peran' => $t->pengguna?->peran,
                ];
            });

        return response()->json([
            'pengaduan' => [
                'pengaduan_id' => $pengaduan->pengaduan_id,
                'judul'        => $pengaduan->judul,
                'deskripsi'    => $pengaduan->deskripsi,
                'status'       => $pengaduan->status,
                'kategori'     => $pengaduan->kategori?->nama_kategori,
                'tanggal'      => $pengaduan->tanggal_dibuat,
                'pelapor'      => $pengaduan->pengguna?->name,
            ],
            'pesan' => $pesan,
        ]);
    }

    /**
     * POST /api/inbox/{pengaduan_id}/kirim
     * Kirim pesan baru dalam thread
     */
    public function kirim(Request $request, $pengaduanId)
    {
        $request->validate([
            'teks' => 'required|string|max:2000',
        ]);

        $user = auth()->user();

        $pengaduan = Pengaduan::where('pengaduan_id', $pengaduanId)->firstOrFail();

        if ($user->peran === 'orangtua' && $pengaduan->user_id !== $user->user_id) {
            abort(403);
        }

        $tanggapan = Tanggapan::create([
            'pengaduan_id'      => $pengaduan->pengaduan_id,
            'user_id'           => $user->user_id,
            'teks_tanggapan'    => $request->teks,
            'tanggal_tanggapan' => now(),
        ]);

        // Otomatis ubah status tertunda → dalam_proses
        if ($pengaduan->status === 'tertunda') {
            $pengaduan->update(['status' => 'dalam_proses']);
        }

        return response()->json([
            'pesan' => [
                'tanggapan_id'   => $tanggapan->tanggapan_id,
                'teks'           => $tanggapan->teks_tanggapan,
                'waktu'          => $tanggapan->tanggal_tanggapan,
                'dari_ku'        => true,
                'pengirim_nama'  => $user->name,
                'pengirim_peran' => $user->peran,
            ],
        ], 201);
    }

    /**
     * DELETE /api/inbox/pesan/{tanggapan_id}
     * Hapus pesan (admin/petugas saja)
     */
    public function hapusPesan($tanggapanId)
    {
        $user = auth()->user();

        if ($user->peran === 'orangtua') {
            abort(403, 'Tidak diizinkan menghapus pesan.');
        }

        $tanggapan = Tanggapan::where('tanggapan_id', $tanggapanId)->firstOrFail();
        $tanggapan->delete();

        return response()->json(['message' => 'Pesan berhasil dihapus']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Simpan tanggapan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id'   => 'required|exists:pengaduans,pengaduan_id',
            'teks_tanggapan' => 'required|string'
        ]);

        // ✅ Ambil pengaduan
        $pengaduan = Pengaduan::where('pengaduan_id', $request->pengaduan_id)
            ->firstOrFail();

        // 🔐 Orangtua hanya boleh tanggapi pengaduannya sendiri
        if (
            auth()->user()->peran === 'orangtua' &&
            $pengaduan->user_id !== auth()->user()->user_id
        ) {
            abort(403);
        }

        // ✅ Simpan tanggapan
        Tanggapan::create([
            'pengaduan_id'      => $pengaduan->pengaduan_id,
            'user_id'           => auth()->user()->user_id,
            'teks_tanggapan'    => $request->teks_tanggapan,
            'tanggal_tanggapan' => now(),
        ]);

        // 🔄 Jika masih tertunda → otomatis jadi dalam_proses
        if ($pengaduan->status === 'tertunda') {
            $pengaduan->update([
                'status' => 'dalam_proses'
            ]);
        }

        // 🔔 NOTIFIKASI
        if (in_array(auth()->user()->peran, ['admin', 'petugas'])) {

            // Admin/Petugas → Orangtua
            Notifikasi::create([
                'user_id'      => $pengaduan->user_id,
                'pengaduan_id' => $pengaduan->pengaduan_id,
                'pesan'        => 'Ada tanggapan baru pada pengaduan Anda'
            ]);

        } else {

            // Orangtua → Admin & Petugas
            $petugas = User::whereIn('peran', ['admin', 'petugas'])->get();

            foreach ($petugas as $user) {
                Notifikasi::create([
                    'user_id'      => $user->user_id,
                    'pengaduan_id' => $pengaduan->pengaduan_id,
                    'pesan'        => 'Orang tua menambahkan tanggapan pada pengaduan'
                ]);
            }
        }

        return back()->with('success', 'Tanggapan berhasil dikirim');
    }

    /**
     * Hapus tanggapan
     */
    public function destroy($id)
    {
        $tanggapan = Tanggapan::where('tanggapan_id', $id)->firstOrFail();

        // 🔐 Orangtua tidak boleh hapus tanggapan
        if (auth()->user()->peran === 'orangtua') {
            abort(403);
        }

        $tanggapan->delete();

        return back()->with('success', 'Tanggapan berhasil dihapus');
    }
}

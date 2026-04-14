<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\RiwayatStatus;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $query = Pengaduan::with(['pengguna', 'kategori'])
            ->orderByDesc('pengaduan_id');

        if ($user->peran === 'orangtua') {
            $query->where('user_id', $user->user_id);
        }

        $pengaduans = $query->paginate(10);

        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'judul'       => 'required',
            'deskripsi'   => 'required',
            'lampiran'    => 'nullable|file|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('lampiran')) {
            $fileName = $request->file('lampiran')->store('lampiran', 'public');
        }

        $pengaduan = Pengaduan::create([
            'user_id'        => auth()->user()->user_id,
            'kategori_id'    => $request->kategori_id,
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'lampiran'       => $fileName,
            'status'         => 'tertunda',
            'tanggal_dibuat' => now(),
            'konfirmasi_orangtua' => 'menunggu',
        ]);

        // 🔥 riwayat awal
        RiwayatStatus::create([
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status'       => 'tertunda',
            'tanggal_ubah' => now(),
            'diubah_oleh'  => auth()->user()->user_id,
        ]);

        // 🔔 notifikasi ke admin & petugas
        $petugas = User::whereIn('peran', ['admin', 'petugas'])->get();

        foreach ($petugas as $user) {
            Notifikasi::create([
                'user_id'      => $user->user_id,
                'pengaduan_id' => $pengaduan->pengaduan_id,
                'pesan'        => auth()->user()->name . ' mengirim pengaduan baru',
                'tanggal_dikirim' => now(),
            ]);
        }

        return redirect()
            ->route(auth()->user()->peran . '.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapans.pengguna', 'rating'])
            ->where('pengaduan_id', $id)
            ->firstOrFail();

        // 🔒 orang tua hanya bisa lihat miliknya
        if (
            auth()->user()->peran === 'orangtua' &&
            $pengaduan->user_id !== auth()->user()->user_id
        ) {
            abort(403);
        }

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        abort_if(!in_array(auth()->user()->peran, ['admin', 'petugas']), 403);

        $request->validate([
            'status' => 'required|in:tertunda,dalam_proses,selesai'
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'konfirmasi_orangtua' => $request->status == 'selesai'
                ? 'menunggu'
                : $pengaduan->konfirmasi_orangtua
        ]);

        // 🔥 simpan riwayat
        RiwayatStatus::create([
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status'       => $request->status,
            'tanggal_ubah' => now(),
            'diubah_oleh'  => auth()->user()->user_id,
        ]);

        // 🔔 notifikasi ke orang tua
        Notifikasi::create([
            'user_id'      => $pengaduan->user_id,
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'pesan'        => 'Status pengaduan Anda menjadi ' . ucfirst(str_replace('_', ' ', $request->status)),
            'tanggal_dikirim' => now(),
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $user = auth()->user();

        // 🔒 ADMIN → soft delete
        if ($user->peran === 'admin') {
            $pengaduan->delete();
        }

        // 🔒 ORANG TUA → batalkan
        elseif ($user->peran === 'orangtua') {

            if ($pengaduan->user_id != $user->user_id) {
                abort(403);
            }

            if ($pengaduan->status !== 'tertunda') {
                return back()->with('error', 'Pengaduan tidak bisa dibatalkan');
            }

            $pengaduan->update([
                'status' => 'dibatalkan'
            ]);

            // 🔥 riwayat
            RiwayatStatus::create([
                'pengaduan_id' => $pengaduan->pengaduan_id,
                'status'       => 'dibatalkan',
                'tanggal_ubah' => now(),
                'diubah_oleh'  => $user->user_id,
            ]);

            $pengaduan->delete();
        } else {
            abort(403);
        }

        return back()->with('success', 'Pengaduan berhasil dibatalkan');
    }

    public function konfirmasi(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->user_id != auth()->user()->user_id) {
            abort(403);
        }

        $request->validate([
            'konfirmasi' => 'required|in:sesuai,tidak_sesuai'
        ]);

        $pengaduan->update([
            'konfirmasi_orangtua' => $request->konfirmasi
        ]);

        if ($request->konfirmasi == 'tidak_sesuai') {
            $pengaduan->update([
                'status' => 'dalam_proses'
            ]);

            // 🔥 riwayat ulang
            RiwayatStatus::create([
                'pengaduan_id' => $pengaduan->pengaduan_id,
                'status'       => 'dalam_proses',
                'tanggal_ubah' => now(),
                'diubah_oleh'  => auth()->user()->user_id,
            ]);
        }

        return back()->with('success', 'Konfirmasi berhasil dikirim!');
    }

    public function detail($id)
    {
        $pengaduan = Pengaduan::with('rating')
            ->where('pengaduan_id', $id)
            ->firstOrFail();

        $pengaduanLain = Pengaduan::where('pengaduan_id', '<>', $id)
            ->orderByDesc('tanggal_dibuat')
            ->limit(5)
            ->get();

        return view('layouts.part.detail', compact('pengaduan', 'pengaduanLain'));
    }

    // ✅ FITUR BARU: TOLAK PENGADUAN
    public function tolak(Request $request, $id)
    {
        abort_if(!in_array(auth()->user()->peran, ['admin', 'petugas']), 403);

        $request->validate([
            'alasan_ditolak' => 'required|string|max:500'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // ❌ tidak boleh tolak kalau sudah selesai
        if (in_array($pengaduan->status, ['selesai', 'ditolak', 'dibatalkan'])) {
            return back()->with('error', 'Pengaduan tidak bisa ditolak');
        }

        $pengaduan->update([
            'status' => 'ditolak',
            'alasan_ditolak' => $request->alasan_ditolak
        ]);

        // 🔥 simpan riwayat
        RiwayatStatus::create([
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status' => 'ditolak',
            'tanggal_ubah' => now(),
            'diubah_oleh' => auth()->user()->user_id,
        ]);

        Notifikasi::create([
            'user_id' => $pengaduan->user_id,
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'pesan' => 'Pengaduan Anda ditolak. Alasan: ' . $request->alasan_ditolak
        ]);

        return back()->with('success', 'Pengaduan berhasil ditolak');
    }
}

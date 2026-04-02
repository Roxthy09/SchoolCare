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
        ]);

        RiwayatStatus::create([
            'riwayat_id'   => null, // auto-increment
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status'       => 'tertunda',
            'tanggal_ubah' => now(),
            'diubah_oleh'  => auth()->user()->user_id,
        ]);

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
        $pengaduan = Pengaduan::with(['kategori', 'tanggapans.pengguna'])
            ->where('pengaduan_id', $id)
            ->firstOrFail();

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
        ]);

        RiwayatStatus::create([
            'riwayat_id'   => null, // auto-increment
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'status'       => $request->status,
            'tanggal_ubah' => now(),
            'diubah_oleh'  => auth()->user()->user_id,
        ]);

        // 🔔 NOTIFIKASI KE ORANGTUA
        Notifikasi::create([
            'user_id'      => $pengaduan->user_id,
            'pengaduan_id' => $pengaduan->pengaduan_id,
            'pesan'        => 'Status pengaduan Anda berubah menjadi ' . ucfirst(str_replace('_', ' ', $request->status))
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $user = auth()->user();

        // 🔒 ADMIN (hapus soft delete saja)
        if ($user->peran === 'admin') {
            $pengaduan->delete();
        }

        // 🔒 ORANGTUA = BATALKAN
        elseif ($user->peran === 'orangtua') {

            // hanya boleh miliknya sendiri
            if ($pengaduan->user_id != $user->user_id) {
                abort(403);
            }

            // hanya bisa jika belum diproses
            if ($pengaduan->status !== 'tertunda') {
                return back()->with('error', 'Pengaduan tidak bisa dibatalkan');
            }

            // 🔥 update status + soft delete
            $pengaduan->update([
                'status' => 'dibatalkan'
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

        // 🔒 hanya pemilik yang boleh
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
        }

        return back()->with('success', 'Konfirmasi berhasil dikirim!');
    }
}

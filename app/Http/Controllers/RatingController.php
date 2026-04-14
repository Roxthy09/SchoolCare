<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use App\Services\BadWordFilter;

class RatingController extends Controller
{
    public function store(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->user_id != Auth::id()) {
            abort(403);
        }

        if ($pengaduan->konfirmasi_orangtua != 'sesuai') {
            return back()->with('error', 'Konfirmasi dulu sebelum memberi rating!');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

             // Cek kata kasar di komentar
        if ($request->filled('komentar') && BadWordFilter::contains($request->komentar)) {
            return back()
                ->withInput()
                ->withErrors(['komentar' => 'Komentar mengandung kata yang tidak pantas. Mohon gunakan bahasa yang sopan.']);
        }

        Rating::updateOrCreate(
            [
                'pengaduan_id' => $id,
                'user_id' => Auth::id()
            ],
            [
                'rating' => $request->rating,
                'komentar' => $request->komentar
            ]
        );

        return back()->with('success', 'Rating berhasil dikirim!');
    }
}

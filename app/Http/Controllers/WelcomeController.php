<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Rating;


class WelcomeController extends Controller
{

    public function index()
    {
        $pengaduanTerbaru = Pengaduan::with(['pengguna', 'kategori','rating'])
            ->orderBy('tanggal_dibuat', 'desc')
            ->take(3)
            ->get();

        $reviews = Rating::with('user', 'pengaduan')
            ->latest()
            ->take(3)
            ->get();
        return view('welcome', compact('pengaduanTerbaru', 'reviews'));
    }
}

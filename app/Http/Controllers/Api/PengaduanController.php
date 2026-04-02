<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $data = Pengaduan::where('user_id', $user->user_id)
            ->latest('tanggal_dibuat')
            ->get();

        return response()->json($data);
    }
}

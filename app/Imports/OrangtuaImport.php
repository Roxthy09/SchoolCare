<?php

namespace App\Imports;

use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrangtuaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {

            // ⛔ skip jika email sudah ada
            if (User::where('email', $row['email'])->exists()) {
                return null;
            }

            // 1️⃣ buat user
            $user = User::create([
                'name'     => $row['nama_orangtua'],
                'email'    => $row['email'],
                'password' => Hash::make('orangtua123'),
                'peran'    => 'orangtua',
            ]);

            // 2️⃣ return model orangtua (akan auto insert)
            return new OrangTua([
                'user_id'       => $user->user_id,
                'nama_orangtua' => $row['nama_orangtua'],
                'nama_siswa'    => $row['nama_siswa'],
                'kelas_siswa'   => $row['kelas_siswa'],
                'no_kontak'     => $row['no_kontak'],
            ]);
        });
    }

    public function rules(): array
    {
        return [
            '*.nama_orangtua' => 'required',
            '*.email'         => 'required|email',
            '*.nama_siswa'    => 'required',
            '*.kelas_siswa'   => 'required',
            '*.no_kontak'     => 'required',
        ];
    }
}

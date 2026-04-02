<?php

namespace App\Imports;

use App\Models\User;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {

                // SKIP jika kosong
                if (!$row['email']) continue;

                // ✅ 1. SIMPAN USER
                $user = User::create([
                    'name'     => $row['name'],
                    'email'    => $row['email'],
                    'password' => Hash::make($row['password']),
                    'peran'    => $row['peran'],
                ]);

                // ✅ 2. JIKA ORANGTUA
                if ($row['peran'] === 'orangtua') {
                    OrangTua::create([
                        'user_id'       => $user->user_id,
                        'nama_orangtua'        => $row['name'],
                        'nama_siswa'    => $row['nama_siswa'],
                        'kelas_siswa'   => $row['kelas_siswa'],
                        'no_kontak'      => $row['no_kontak'],
                    ]);
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            dd('ERROR:', $e->getMessage());
        }
    }
}
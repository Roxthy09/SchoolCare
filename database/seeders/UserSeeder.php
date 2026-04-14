<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat Admin
    User::create([
        'name' => 'Administrator',
        'email' => 'admin@schoolcare.sch.id',
        'password' => Hash::make('schoolcare.admin'),
        'peran' => 'admin',
    ]);

    // Buat Petugas
    User::create([
        'name' => 'Petugas Ujikom',
        'email' => 'petugas@schoolcare.sch.id',
        'password' => Hash::make('schoolcare.petugas'),
        'peran' => 'petugas',
    ]);

     User::create([
        'name' => 'Orang Tua',
        'email' => 'orangtua@gmail.com',
        'password' => Hash::make('password'),
        'peran' => 'orangtua',
    ]);
    }
}

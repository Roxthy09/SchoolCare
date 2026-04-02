<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
     protected $table = 'orang_tuas';
    protected $primaryKey = 'orangtua_id';
    public $timestamps = true;
     protected $casts = [
        'created_at' => 'datetime',
    ]; 

    protected $fillable = [
        'user_id',
        'nama_orangtua',
        'nama_siswa',
        'kelas_siswa',
        'no_kontak',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

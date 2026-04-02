<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'notifikasi_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pengaduan_id',
        'pesan',
        'sudah_dibaca',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }
}

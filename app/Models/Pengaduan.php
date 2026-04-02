<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaduan extends Model
{
    use SoftDeletes;
    protected $table = 'pengaduans';
    protected $primaryKey = 'pengaduan_id';
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'pengaduan_id';
    }

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lampiran',
        'status',
        'konfirmasi_orangtua',
        'tanggal_dibuat',
        'tanggal_diubah',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function riwayatStatuses()
    {
        return $this->hasMany(RiwayatStatus::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'pengaduan_id', 'pengaduan_id');
    }
}

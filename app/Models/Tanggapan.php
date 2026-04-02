<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapans';
    protected $primaryKey = 'tanggapan_id';
    public $timestamps = false;

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'teks_tanggapan',
        'tanggal_tanggapan',
    ];
    
    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

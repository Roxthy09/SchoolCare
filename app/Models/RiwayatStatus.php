<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_statuses';
    protected $primaryKey = 'riwayat_id';
    public $timestamps = false;

    protected $fillable = [
        'pengaduan_id',
        'status',
        'diubah_oleh',
    ];

    protected $casts = [
        'tanggal_ubah' => 'datetime', // ⬅ INI PENTING
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'diubah_oleh', 'user_id');
    }

}

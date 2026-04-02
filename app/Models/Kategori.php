<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'kategori_id';
    public $timestamps = false;
    

    protected $fillable = ['nama_kategori'];

     public function getRouteKeyName()
    {
        return 'kategori_id';
    }

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'kategori_id');
    }
}

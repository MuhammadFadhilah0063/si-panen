<?php

namespace App\Models;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Gapoktan;
use App\Models\Poktan;
use App\Models\FotoHasilPanen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panens';

    protected $fillable = [
        'luas_lahan',
        'kelompok_tani',
        'alamat_ubinan',
        'gkp',
        'gkg',
        'hasil_produksi',
        'detail_hasil_produksi',
        'url_lokasi',
        'kecamatan_id',
        'kelurahan_id',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function gapoktan()
    {
        return $this->belongsTo(Gapoktan::class, 'kelompok_id');
    }

    public function poktan()
    {
        return $this->belongsTo(Poktan::class, 'kelompok_id');
    }

    public function penyuluh()
    {
        return $this->belongsTo(Penyuluh::class, 'penyuluh_id');
    }

    public function foto_hasil()
    {
        return $this->hasMany(FotoHasilPanen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

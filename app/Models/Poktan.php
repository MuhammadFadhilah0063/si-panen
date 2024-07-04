<?php

namespace App\Models;

use App\Models\Kecamatan;
use App\Models\Penyuluh;
use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poktan extends Model
{
    use HasFactory;

    protected $table = "poktans";

    protected $fillable = [
        'nama_petani',
        'luas_lahan_poktan',
        'no_hp_poktan',
        'alamat_poktan',
        'kecamatan_id',
        'penyuluh_id',
        'kelompok_id',
        'status_poktan',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
    ];

    public function getTtlAttribute()
    {
        return $this->tempat_lahir . ', ' . \Carbon\Carbon::parse($this->tgl_lahir)->format('d-m-Y');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function penyuluh()
    {
        return $this->belongsTo(Penyuluh::class);
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
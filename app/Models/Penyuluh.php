<?php

namespace App\Models;

use App\Models\Poktan;
use App\Models\Gapoktan;
use App\Models\HasilPanen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyuluh extends Model
{
    use HasFactory;

    protected $table = "penyuluhs";

    protected $fillable = [
        'nama_penyuluh',
        'nip_penyuluh',
        'no_hp_penyuluh',
        'alamat_penyuluh',
        'poktan_id',
        'gapoktan_id',
    ];

    public function poktan()
    {
        return $this->belongsTo(Poktan::class);
    }

    public function gapoktan()
    {
        return $this->belongsTo(Gapoktan::class);
    }

    public function hasilpanen()
    {
        return $this->hasMany(HasilPanen::class);
    }
}

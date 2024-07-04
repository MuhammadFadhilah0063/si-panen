<?php

namespace App\Models;

use App\Models\Poktan;
use App\Models\Gapoktan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = "kelompoks";

    protected $fillable = [
        'nama_kelompok'
    ];

    public function poktan()
    {
        return $this->hasMany(Poktan::class);
    }

    public function gapoktan()
    {
        return $this->hasMany(Gapoktan::class);
    }
}

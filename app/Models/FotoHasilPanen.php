<?php

namespace App\Models;

use App\Models\HasilPanen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoHasilPanen extends Model
{
    use HasFactory;

    protected $table = 'foto_hasil_panens';

    protected $fillable = [
        'nama',
        'hasil_panen_id',
    ];

    public function hasilPanen()
    {
        return $this->belongsTo(HasilPanen::class);
    }
}

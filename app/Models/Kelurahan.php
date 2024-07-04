<?php

namespace App\Models;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = "kelurahans";

    protected $fillable = [
        "nama",
        "kecamatan_id"
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}

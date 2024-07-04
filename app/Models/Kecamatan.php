<?php

namespace App\Models;

use App\Models\Kelurahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = "kecamatan";

    protected $fillable = [
        "nama"
    ];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function hasilPanen()
    {
        return $this->hasMany(HasilPanen::class);
    }
}

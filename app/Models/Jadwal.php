<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $guarded = [];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class,'lapangan_id');
    }

    public function bayar()
    {
        return $this->hasMany(Bayar::class,'jadwal_id');
    }
}

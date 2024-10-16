<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangans';
    protected $guarded = [];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class,'lapangan_id');
    }
}

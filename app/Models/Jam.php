<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $table = 'jams';
    protected $guarded = [];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class,'lapangan_id');
    }
}

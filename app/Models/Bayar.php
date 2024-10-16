<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;

    protected $table = 'bayars';
    protected $guarded = [];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

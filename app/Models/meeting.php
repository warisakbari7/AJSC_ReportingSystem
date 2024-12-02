<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meeting extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(province::class);
    }
    public function participants()
    {
        return $this->hasMany(participant::class);
    }
}


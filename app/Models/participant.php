<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    use HasFactory;
    public function province()
    {
        return $this->belongsTo(province::class);
    }
}

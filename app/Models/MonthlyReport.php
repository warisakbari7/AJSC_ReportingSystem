<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    use HasFactory;
    // const $fillable = [
    //     'content',
    //     'date',
    //     'user_id'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

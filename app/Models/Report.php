<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\meeting;
use App\Models\detailsreport;
class Report extends Model
{
    use HasFactory;
    public  function  user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(ReportImage::class);
    }
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function details()
    {
        return $this->hasMany(detailsreport::class);
    }
}

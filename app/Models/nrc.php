<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nrc extends Model
{
    use HasFactory;
    public function nrc(){
        return $this->belongsTo(nrc::class);
    }
}

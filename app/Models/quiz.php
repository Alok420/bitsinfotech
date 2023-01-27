<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;


    function getSubject(){
        return $this->belongsTo(subject::class,"subject_id");
       }
}

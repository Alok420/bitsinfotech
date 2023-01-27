<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;


    function getCourse(){
        return $this->hasMany(user_course::class,"student_id");
       }

}

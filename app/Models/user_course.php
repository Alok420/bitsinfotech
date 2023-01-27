<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_course extends Model
{
    use HasFactory;
    protected $table="user_course";

    function getCourse(){
        return $this->belongsTo(course::class,"course_id");
       }

    function getFees(){

        return $this->hasMany(student_fees::class,"course_id");

    }


}

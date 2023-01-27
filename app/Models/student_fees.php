<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_fees extends Model
{
    use HasFactory;

    function getStudent(){
        return $this->belongsTo(Student::class,"student_id");
    }

    function getCourse(){

        return $this->belongsTo(course::class,"course_id");
    }
}

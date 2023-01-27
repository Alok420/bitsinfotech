<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_subject extends Model
{
    use HasFactory;
    protected $table="course_subject";

    function getCourse(){
        return $this->belongsTo(course::class,"course_id");
    }
    
    function getSubject(){
        return $this->belongsTo(subject::class,"subject_id");

    }
}

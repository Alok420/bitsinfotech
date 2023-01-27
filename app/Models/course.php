<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
   protected $primaryKey="id";
     protected $table="courses";

    function get_Course_Subject(){
      return $this->hasMany(course_subject::class,"course_id");
    }
}

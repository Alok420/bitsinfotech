<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;
    protected $table="answer";

    function getQuestion(){
        return $this->belongsTo(question::class,"question_id");
       }
}

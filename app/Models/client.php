<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class client extends Model
{
    use HasFactory;
    use SoftDeletes;
   protected  $primaryKey="id";
   protected $table="clients";

   function getCourse(){
    return $this->belongsTo(course::class,"course_id");
   }

   function getBatch(){
    return $this->belongsTo(batch::class,"batch_id");
   }
   function getCity(){
    return $this->belongsTo(city::class,"city_id");
   }

}

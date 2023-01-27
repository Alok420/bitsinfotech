<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\course;



class StudentController extends Controller
{
    public function index($token_id){


        $course=course::find($token_id);

            if($course){

                return response()->json($course,200);
            }else{

                return response()->json("No data found",400);
             }

    }
}

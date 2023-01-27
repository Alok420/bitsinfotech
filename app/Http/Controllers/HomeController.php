<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;
use App\Models\course;
use Illuminate\Support\Facades\DB;
use App\Models\batch;

use App\Models\city;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $url=$_SERVER['REQUEST_URI'];

        $new_url=DIRNAME($url,1);  //it gives parent directory  path second parameter is parent level
         $nav=trim($new_url,"/");

         $basename=basename($url);
        $course=course::all();
        $batch=batch::all();
        $city=city::all();
        $qry= DB::table('students')->select(DB::raw('count(*) as total'))->get();
        $qry2= DB::table('students')->select(DB::raw('count(*) as total'))->where('status', '=', '1')->get();
        
         
        $total_student=$qry[0]->total;
        $total_active_student=$qry2[0]->total;
       
        


        $data=compact("nav","basename","total_student","total_active_student");
        return view('dashboard')->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



use App\Models\User;

class UserController extends Controller
{
    function getNav(){
        $url=$_SERVER['REQUEST_URI'];

        $new_url=DIRNAME($url,1);  //it gives parent directory  path second parameter is parent level
         return $nav=trim($new_url,"/");

        }
        function getBase(){
            $url=$_SERVER['REQUEST_URI'];
            return basename($url);
        }

    function index(){
        $nav=$this->getNav();
        $basename=$this->getBase();
        $user=User::all();

        $data=compact("nav","basename","user");
        return view("user-list")->with($data);
    }
}

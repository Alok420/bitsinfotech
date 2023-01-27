<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function getNav(){
        $url=$_SERVER['REQUEST_URI'];

        $new_url=DIRNAME($url,1);  //it gives parent directory  path second parameter is parent level
         return $nav=trim($new_url,"/");

        }
    function getBase(){
        $url=$_SERVER['REQUEST_URI'];
        return basename($url);
    }

    public function index()
    {

       $nav=$this->getNav();
       $basename=$this->getBase();
        $city=city::all();
        $data=compact("city","nav","basename");
        return view("city")->with($data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcity(Request $request)
    {

        if(isset($request['id'])){
         $id=$request['id'];
         $city=city::find($id);

         $city->name=$request['name'];
         $city->state=$request['state'];
        $city->save();
        $request->session()->flash("status","Updated Successfully");
        }else{
        $city=new city();
        $city->name=$request['name'];
        $city->save();
        $request->session()->flash("status","Added Successfully");
        }
        return redirect("city/add-city");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $nav=$this->getNav();
        $basename=$this->getBase();
      $city_single=city::find($id);
      $city=city::all();
      $data=compact("city_single","city","nav","basename");
      return view("city")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
      $city=city::find($id);
      if($city){
        $city->delete();
        $request->session()->flash("status","Deleted Successfully");


      }
      return redirect("city/add-city");

    }
}

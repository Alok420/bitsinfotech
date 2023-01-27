<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\batch;

use App\Models\course;
use App\Models\city;
use Illuminate\Http\Request;
use PDF;
class ClientController extends Controller
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



    public function index(Request $request)
    {


    //    echo "<pre>";
    //     print_r($url) ."<br>";
    //     echo "</pre>";

    //      echo "<pre>";
    //     print_r($new_url) ."<br>";
    //     echo "</pre>";
    //     echo $nav;

    //     die;
   $basename=$this->getBase();


    $nav=$this->getNav();
       if($request['search']){
         $search=$request['search'];

         $client=client::where("name","LIKE","%$search%")->get();

       }else{
        $client=client::orderBy('id','desc')->paginate(5);
        $search="";
       }

        $data=compact("client","search","nav","basename");


        return view("client-list")->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function force_delete($id,Request $request){

         $client=client::withTrashed()->find($id);

         if($client){
         $client->forceDelete();
         $request->session()->flash("status","Client deleted successfully");
         }


        return redirect("client/trash-list");
     }

     public function crestore($id,Request $request){

      $client=client::withTrashed()->find($id);
       if($client){
        $client->restore();
        $request->session()->flash("status","Client Restored successfully");
       }

       return redirect("client/trash-list");
     }

    public function trash_list(Request $request)
    {
        $basename=$this->getBase();
        $nav=$this->getNav();
        if($request['search']){
            $search=$request['search'];
            $client=client::onlyTrashed()->where("name","LIKE","%$search%")->get();


        }else{
            $client=client::onlyTrashed()->get();


        }




      $data=compact("client","nav","basename");
      return view("trash-list")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
         "name"=>"required",
         "caste"=>"required",
         "email"=>"required|email",
         "contact"=>"max:10",
         "hobby"=>"required"

        ],['hobby.required'=>'Select Atleast One']);
        if($request['hobby']){
        $hobby=$request['hobby'];
        $hobbies=implode(",",$hobby);
        }else{
            $hobbies="";
        }

        $client=new client;
        $client->name=$request['name'];
        $client->email=$request['email'];
        $client->contact=$request['contact'];
        $client->gender=$request['gender'];
        $client->caste=$request['caste'];
        $client->course_id=$request['course'];
        $client->batch_id=$request['batch'];
        $client->city_id=$request['city'];
        $client->hobbies=$hobbies;


        if($request->file("photo")){
        $fileName= time()."-slaravel.".$request->file("photo")->getClientOriginalExtension();

        $request->file("photo")->move("upload",$fileName);
        $client->photo=$fileName;
        }
        $client->save();
        $request->session()->flash('status',"Client Added successfully");
        return redirect("client/clist");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $client=client::all();
       $pdf=PDF::loadView("client-pdf",['client'=>$client]);
       return $pdf->download("my-download.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function cedit($id)
    {
        $client=client::find($id);
        $city=city::all();
        $nav=$this->getNav();
        $basename=$this->getBase();
        $url=route('cupdate',['id'=>$id]);
        $heading="Client Edit Form";
         $course=course::all();
         $batch=batch::all();
        $data=compact("client","url","heading","course","batch","city","nav","basename");
        return view("home")->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function cupdate(Request $request,$id)
    {

        $request->validate([
            "name"=>"required",
            "caste"=>"required",
            "email"=>"required|email",
            "contact"=>"max:10"

           ]);

           if($request['hobby']){
            $hobby=$request['hobby'];
            $hobbies=implode(",",$hobby);
            }else{
                $hobbies="";
            }
           $client=client::find($id);
           $client->name=$request['name'];
           $client->email=$request['email'];
           $client->contact=$request['contact'];
           $client->gender=$request['gender'];
           $client->caste=$request['caste'];
           $client->course_id=$request['course'];
           $client->batch_id=$request['batch'];
           $client->city_id=$request['city'];
           $client->hobbies=$hobbies;
           if($request->file("photo")){
           $fileName= time()."-slaravel.".$request->file("photo")->getClientOriginalExtension();

           $request->file("photo")->move("upload",$fileName);
           $client->photo=$fileName;
           }
           $client->save();
            $request->session()->flash('status',"Updated successfully");
           return redirect("client/clist");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $client=client::find($id);
       if($client){
         $client->delete();
         $request->session()->flash('status',"Client move to trash successfully");
       }
     return redirect("client/clist");

    }
}

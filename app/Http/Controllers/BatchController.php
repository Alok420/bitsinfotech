<?php

namespace App\Http\Controllers;

use App\Models\batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batch=batch::all();
        $data=compact("batch");
        return view("batch")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $batch=new batch;
        $batch->shift=$request['name'];
        $data=$batch->save();
         if($data){

             $request->session()->flash("status","Added Successfully");
         }else{
            $request->session()->flash("status","Something went wrong!");
         }
         return redirect("/batch/batch-page");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(batch $batch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, batch $batch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
      $batch=batch::find($id);
      if($batch){
        $batch->delete();
        $request->session()->flash("status","Deleted successfully.");

      }
      return redirect("/batch/batch-page");
    }
}

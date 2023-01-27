<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\subject;
use App\Models\course_subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){

        $this->middleware('auth');
     }

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

        $course=course::all();
        $data=compact("course","nav","basename");

      return view("course")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcourse(Request $request)
    {
        if(isset($request['id'])){
            $id=$request['id'];
            $course=course::find($id);
            $course->name=$request['name'];
            $course->fees=$request['fees'];
            $course->duration=$request['duration'];

            if($request->file("course-image")){
                $fileName= time()."-Tlaravel.".$request->file("image")->getClientOriginalExtension();

                $request->file("image")->move("upload",$fileName);
                $course->image=$fileName;
                }
            $course->save();
            $request->session()->flash("status","Course Updated Successfully.");

        }else{
        $course=new course;
        $course->name=$request['name'];
        $course->fees=$request['fees'];
        $course->description=$request['description'];


        // echo $request->file("course-image");
        // die;

        $course->duration=$request['duration'];

        if($request->file("course-image")){
            $fileName= time()."-Tlaravel.".$request->file("course-image")->getClientOriginalExtension();

            $request->file("course-image")->move("upload",$fileName);
            $course->image=$fileName;
            }
        $course->save();
        $request->session()->flash("status","Course added Successfully.");
        }
        return redirect("/course/course-form");

    }

    public function getfees(Request $request){
        $id=$request['id'];
        $course=course::find($id);
        $course_fees="Course-fees: ".$course->fees;

        return json_encode($course_fees);




    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function course_subject(){

        $nav=$this->getNav();
        $basename=$this->getBase();



        $course=course::all();
        $subject=subject::all();
        


       // dd($course[0]->get_Course_Subject[0]->getSubject);


        $data=compact("course","nav","basename","subject");


        return view("course-subject")->with($data);

     }

    public function add_course_subject(Request $request)
    {


       $course_subject=new course_subject;

       $course_subject->course_id=$request['course-id'];
       $course_subject->subject_id=$request['subject-id'];
       $course_subject->save();
       $request->session()->flash("status","Updated Successfully.");
       return redirect("course/course-subject");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nav=$this->getNav();
        $basename=$this->getBase();
       $course_single=course::find($id);
       $course=course::all();
       $data=compact("course","course_single","nav","basename");

       return view("course",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $course=course::find($id);
        if($course){
            $course->delete();
            $request->session()->flash("status","Course deleted Successfully");
        }
       return redirect("course/course-form");
    }
}

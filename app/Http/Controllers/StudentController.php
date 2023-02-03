<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\user;
use App\Models\course;
use App\Models\student_fees;
use App\Models\user_course;
use App\Models\course_subject;
use App\Models\subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function getNav()
    {
        $url = $_SERVER['REQUEST_URI'];

        $new_url = DIRNAME($url, 1);  //it gives parent directory  path second parameter is parent level
        return $nav = trim($new_url, "/");
    }
    function getBase()
    {
        $url = $_SERVER['REQUEST_URI'];
        return basename($url);
    }
    public function index()
    {

        $basename = $this->getBase();


        $nav = $this->getNav();
        $url = route('ssave');
        $heading = "Student Form";
        $user = user::where("use", '0')->get();


        $data = compact("url", "heading", "nav", "basename", "user");
        return view("student-form")->with($data);
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

        $request->validate([
            "user-id" => "required"

        ]);

        $student = new student;
        $student->name = $request['name'];
        $student->contact = $request['contact'];
        $student->email = $request['email'];
        $student->address = $request['address'];
        $student->gender = $request['gender'];
        $student->qualification = $request['qualification'];
        $student->start_date = $request['start-date'];
        $student->end_date = $request['end-date'];

        $user_id = $request['user-id'];
        $user = user::find($user_id);
        $user->use = 1;
        $user->save();



        $student->user_id = $user_id;


        $student->save();
        $request->session()->flash("status", "Student Added Successfully.");

        return redirect("/student/add-form");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function list()
    {


        $student = student::all();
        $basename = $this->getBase();
        $heading = "All Student List";


        $nav = $this->getNav();
        // echo "<pre>";
        // print_r($student[0]->getCourse[0]->course_id);
        // echo "</pre>";


        $data = compact("student", "basename", "nav", "heading");
        return view('student-list')->with($data);
    }

    public function active_student_list()
    {


        $student = student::where("status", "1")->get();
        $basename = $this->getBase();


        $nav = $this->getNav();
        $heading = "Active Student List";
        // echo "<pre>";
        // print_r($student[0]->getCourse[0]->course_id);
        // echo "</pre>";

        $data = compact("student", "basename", "nav", "heading");
        return view('student-list')->with($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */

    public function scourse()
    {


        $student = student::all();
        $course = course::all();
        $basename = $this->getBase();


        $nav = $this->getNav();
        $data = compact("student", "basename", "nav", "course");
        return view("scourse-form")->with($data);
    }

    public function scourse_add(Request $request)
    {

        $user_course = new user_course;
        $user_course_qry = user_course::all();

        foreach ($user_course_qry as $u) {

            if ($u->student_id == $request['student-id'] and $u->course_id == $request['course-id']) {
                $request->session()->flash("status", "!Sorry Student Course Already Added.");
                return redirect("student/scourse");
            }
        }

        $user_course->student_id = $request['student-id'];
        $user_course->course_id = $request['course-id'];
        $user_course->final_fees = $request['final-fees'];
        $user_course->save();


        $request->session()->flash("status", "Updated Successfully.");
        return redirect("student/scourse");
    }

    public function sfees()
    {
        $student = student::all();
    
        $basename = $this->getBase();
        $course = course::all();

        $nav = $this->getNav();
        $data = compact("student", "basename", "nav", "course");

        return view('sfees-form')->with($data);
    }
  

    public function sfees_add(Request $request)
    {


        $student_fees = new student_fees;

        $request->validate([
            'course-id' => 'required',
            'student-id' => 'required',
            'amount' => 'required',

        ]);
        //dd($request->all());
        $student_fees->student_id = $request['student-id'];
        $student_fees->course_id = $request['course-id'];
        $student_fees->amount = $request['amount'];
        $student_fees->date = $request['date'];
        $student_fees->method = $request['method'];
        $student_fees->save();


        $request->session()->flash("status", "Fees Added Successfully.");

        return redirect("student/sfees-list");
    }


    public function subject()
    {


        $basename = $this->getBase();


        $nav = $this->getNav();
        $subject = subject::all();

        $data = compact("basename", "nav", "subject");
        return view("subject")->with($data);
    }

    public function addsubject(Request $request)
    {

        $subject = new subject;
        $subject->name = $request['name'];
        $subject->description = $request['description'];
        $subject->save();
        $request->session()->flash("status", "Subject Added Successfully.");
        return redirect("subject/add-subject");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */

    public function deletesubject($id, Request $request)
    {

        $subject = subject::find($id);
        $check = course_subject::where("subject_id", $id)->get();



        if (count($check) != 0) {

            $request->session()->flash('status', "! Not Deleted Something went wrong");
        } else {

            if ($subject) {
                $subject->delete();
                $request->session()->flash('status', "Subject deleted successfully");
            }
        }



        return redirect("subject/add-subject");
    }


    public function show_student_course($id)
    {
        $basename = $this->getBase();
        $nav = "student";
        $student = student::find($id);
        $student_name = $student->name;
        $course = $student->getCourse;

        $student_fees = student_fees::where("student_id", $id)->get();
        $total_fees_paid = 0;

        if ($student_fees) {
            foreach ($student_fees as $sf) {
                $total_fees_paid += $sf->amount;
            }
        }
        
        $data = compact("basename", "nav", "course", "student_name", "total_fees_paid");
        return view("show-student-course")->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */


    public function student_fees_list()
    {
        $basename = $this->getBase();
        $nav = $this->getNav();
        $student_fees = student_fees::all();
        // foreach ($student_fees  as $value) {
        //     echo $value->getStudent->name."--".$value->getStudent->id;
        // }
        $data = compact("nav", "basename", "student_fees");
        return view("student-fees-list")->with($data);
    }


    public function destroy(student $student)
    {
        //
    }
}

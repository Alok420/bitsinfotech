<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\user_course;
use App\Models\student_fees;


use App\Models\course;
use App\Models\question;
use App\Models\quiz;
use App\Models\answer;
use App\Models\student_response;




use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{

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


        $nav = $this->getNav();
        $basename = $this->getBase();
        $student = Auth::user()->getStudent;

        $student_id = Auth::user()->getStudent->id;


        $student_course = user_course::where("student_id", $student_id)->get();


        $data = compact("nav", "basename", "student", "student_course");




        return view("student-profile")->with($data);
    }
    public function invoice($id)
    {

        $transaction = student_fees::where("id", $id)->get();
        $data=compact('transaction');
        return view("invoice.invoice")->with($data);
    }
    public function course()
    {


        $nav = $this->getNav();
        $basename = $this->getBase();
        $student_id = Auth::user()->getStudent->id;

        $user_course = user_course::where('student_id', $student_id)->get();
        $user_course_paid = array();
        foreach ($user_course as $course) {
            $student_fees = student_fees::where('student_id', $student_id)->sum("amount");
            $course["paid_fees"] = $student_fees;
            array_push($user_course_paid, $course);
        }

        $data = compact("user_course_paid", "nav", "basename");
        return view("student-profile-course")->with($data);
    }

    public function quiz()
    {



        $nav = $this->getNav();
        $basename = $this->getBase();
        $question = question::all();
        $answer = answer::all();
        $quiz = quiz::all();

        $data = compact("nav", "basename", "question", "answer", "quiz");

        return view("student-profile-quiz")->with($data);
    }


    public function student_response(Request $request)
    {


        //  $answer_key="right-answer-".$ques_id;

        //     echo "<pre>";

        //    // print_r($request['question-id'][0]);

        //    $answer_key="right-answer-".$request['question-id'][0];

        //    echo $answer_key."<br>";

        //    echo $request[$answer_key]."<br>";

        // echo "dfjh"."<br>";
        //     echo"</pre>";
        //     die;

        $student_id = Auth::user()->getStudent->id;

        $quiz_id = $request['quiz-id'];

        $response_exist = student_response::where('student_id', $student_id)->where('quiz_id', $quiz_id)->delete();


        //dd($response_exist);

        foreach ($request['question-id'] as $ques_id) {


            $student_response_table = new student_response;
            $student_response_table->student_id = $student_id;
            $student_response_table->quiz_id = $request['quiz-id'];
            $student_response_table->question_id = $ques_id;
            $answer_key = "right-answer-" . $ques_id;

            $student_response_table->answer_id = $request[$answer_key];
            $student_response_table->save();
        }

        $request->session()->flash("status", "Your Response Submited Successfully.");

        return redirect("/quiz/student-profile-result/$quiz_id");
    }

    public function quiz_select()
    {


        $nav = $this->getNav();
        $basename = $this->getBase();
        $quiz = quiz::all();

        $data = compact("nav", "basename", "quiz");

        return view("student-profile-result")->with($data);
    }

    public function quiz_select_for_quiz(Request $request)
    {


        $nav = $this->getNav();
        $basename = $this->getBase();
        $quiz = quiz::all();
        $quiz_id = $request['quiz-id'];



        $question = question::where("quiz_id", $quiz_id)->get();

        $find_quiz = quiz::find($quiz_id);
        $quiz_duration = $find_quiz->duration;


        if (count($question) != 0) {


            $data = compact("nav", "basename", "quiz", "quiz_id", "question", "quiz_duration");

            return view('student-profile-quiz')->with($data);
        } else {

            $request->session()->flash("status", "! Sorry question not found in this quiz");

            return redirect("quiz/student-profile-quiz");
        }
    }

    public function quiz_result(Request $request, $id = null)
    {




        if ($id) {
            $for_result_heading = 0;
            $quiz_id = $id;
        } elseif ($request['quiz-id']) {
            $for_result_heading = 1;
            $quiz_id = $request['quiz-id'];
        } else {
            $request->session()->flash('status', "Something went wrong");
            return redirect("/quiz/student-profile-result");
        }

        //dd($request->all());


        $nav = $this->getNav();
        $basename = $this->getBase();
        $student_id = Auth::user()->getStudent->id;

        // $quiz_id=$request['quiz-id'];
        $quiz = quiz::all();
        $quiz_find = quiz::find($quiz_id);
        $quiz_name = $quiz_find->name;
        $quiz_id = $quiz_find->id;






        $student_response = student_response::where('student_id', $student_id)->where('quiz_id', $quiz_id)->get();


        $score = 0;
        $total_question = 0;
        foreach ($student_response as $response) {
            $total_question++;
            $answer_id = $response->answer_id;
            if ($answer_id) {


                $answer_table = answer::find($answer_id);
                if ($answer_table->is_right == 1) {
                    $score++;
                }
            }
        }

        if ($total_question != 0) {
            $percentage = $score * 100 / $total_question;
        } else {


            $request->session()->flash("status", "!Sorry there is no result to show.");

            return redirect("quiz/student-profile-result");
        }






        $quiz_select = 1;


        if ($percentage >= 33) {
            $result_status = "<b style='color:green'>Passed</b>";
        } else {
            $result_status = "<b style='color:red'>Failed</b>";
        }

        $data = compact("nav", "basename", "score", "total_question", "quiz_name", "percentage", "quiz_select", "quiz", "quiz_id", "result_status", "for_result_heading");


        // dd($data);

        return view("student-profile-result")->with($data);
    }

    public function transaction()
    {
        $transaction = student_fees::where("student_id", Auth::user()->getStudent->id)->get();

        $nav = $this->getNav();
        $basename = $this->getBase();
        $data = compact("nav", "basename", "transaction");
        return view('student-profile-transaction')->with($data);
    }
}

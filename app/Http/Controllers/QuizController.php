<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\quiz;
use App\Models\question;
use App\Models\subject;
use App\Models\answer;


use Illuminate\Http\Request;

class QuizController extends Controller
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
     $subject=subject::all();
     $quiz=quiz::all();

     $data=compact("nav","basename","subject","quiz");

      return view("quiz")->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_quiz(Request $request)

    {
        $quiz=new quiz;
        $quiz->name=$request['name'];
        $quiz->duration=$request['duration'];
        $quiz->subject_id=$request['subject-id'];
        $quiz->save();
        $request->session()->flash("status","Quiz Added Succesfully.");
        return redirect("quiz/addquiz");



    }


    public function quiz_select(Request $request){
      $quiz_id=$request['quiz-id'];


             $nav=$this->getNav();
        $basename=$this->getBase();

        $quiz=quiz::all();
        $question=question::all();


        $data=compact("nav","basename","quiz","question","quiz_id");
        return view('question')->with($data);



    }


    public function quiz_select_for_answer(Request $request){
        $quiz_id=$request['quiz-id'];



               $nav=$this->getNav();
          $basename=$this->getBase();

          $quiz=quiz::all();


          $question=question::where("quiz_id",$quiz_id)->get();

        if(count($question)!=0){


            $data=compact("nav","basename","quiz","question","quiz_id");

            return view('answer')->with($data);

            // if($basename=="student-profile-quiz"){
            //       echo "hjhh";
            //       die;

            //     return view('student-profile-quiz')->with($data);

            // }else{
            //       echo $basename;

            //     echo 0;
            //     die;


            // return view('answer')->with($data);
            // }


        }else{



            $request->session()->flash("status","! Sorry question not found in this quiz");

            return redirect("quiz/answer");

        }





      }


    public function question(){
        $nav=$this->getNav();
        $basename=$this->getBase();

        $quiz=quiz::all();
        $question=question::all();


        $data=compact("nav","basename","quiz","question");
        return view('question')->with($data);





    }

    public function add_question(Request $request){
        $nav=$this->getNav();
        $basename=$this->getBase();

        $question=new question;
        $question->question=$request['question'];
        $question->quiz_id=$request['quiz-id'];
        $question->save();
        $request->session()->flash("status","Question Added Succesfully.");

        $quiz_id=$request['quiz-id'];

        $quiz=quiz::all();
        $question=question::all();


        $data=compact("nav","basename","quiz","question","quiz_id");
        return view('question')->with($data);






    }

    public function answer(){


        $nav=$this->getNav();
        $basename=$this->getBase();
        $question=question::all();
        $answer=answer::all();
        $quiz=quiz::all();

        $data=compact("nav","basename","question","answer","quiz");

        return view("answer")->with($data);






    }

    public function add_answer(Request $request){
        $nav=$this->getNav();
        $basename=$this->getBase();


        $question_id=$request['question-id'];





        foreach($question_id as $q_id){

          $current_ques_id=$q_id;
          $answer="answer-".$q_id;
          $right_answer="right-answer-".$q_id;
          $right_answer_key=$request[$right_answer];




        //  $request->validate([
        //     "$answer"    => "required|array|min:4",
        //     "$right_answer" => "required"
        // ]);

        //   print_r($request[$answer]);
        //   die;

            $check_in_answer_table=answer::where("question_id",$q_id)->get();

            //   echo "<pre>";
            //   print_r($check_in_answer_table);
            //   echo "</pre>";
            if(count($check_in_answer_table)){
                $i=0;


                            foreach($check_in_answer_table as $c_answer_table){

                                echo "<pre>";
                                print_r($c_answer_table->answer);
                                echo "<pre>";


                                echo "<pre>";
                                print_r($request[$answer][$i]);
                                echo "<pre>";
                                $c_answer_table->answer=$request[$answer][$i];
                                if($right_answer_key==$i){
                                    $c_answer_table->is_right=1;
                                    }else{
                                        $c_answer_table->is_right='0';
                                    }

                                $c_answer_table->save();
                                // $a=$request[$answer][$i];
                                // $c_answer_table->answer=$a[$i];




                                // $c_answer_table->save();
                                $i++;



                            }



            }else{


                            foreach($request[$answer] as $key=>$a){
                                $answer_table=new answer;

                                $answer_table->question_id=$q_id;
                                $answer_table->answer=$a;

                                if($right_answer_key==$key){
                                $answer_table->is_right=1;
                                }

                                $answer_table->save();



                            }
            }







        }
        $request->session()->flash("status","Added Succesfully.");
        return redirect("/quiz/answer");


        // echo "<pre>";
        // print_r($request['question-id']);
        // echo "</pre>";


        //print_r($request['right-answer-1']);


       // print_r($request['question-id']);






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
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function delete_quiz($id,Request $request)
    {

        $delete_question=question::where("quiz_id",$id)->get();

        if(count($delete_question)){

        foreach($delete_question as $dq){

             if(count($dq->getAnswer)){
                    foreach($dq->getAnswer as $dq_answer){
                        $dq_answer->delete();   //delete all answer related to the quiz
                    }
            }

             $dq->delete();            // delete all question related to the quiz
        }
    }

     $quiz=quiz::find($id);
     $quiz->delete();
     $request->session()->flash("status","Quiz deleted successfully.");

    return redirect("quiz/addquiz");


    }


    public function delete_question($id,Request $request){

     $question=question::find($id);

      if(count($question->getAnswer)){

        foreach($question->getAnswer as $delete_answer){
           $delete_answer->delete();
        }

      }

      $question->delete();

      $request->session()->flash("status","Question deleted successfully.");

      return redirect("quiz/questions");


    }
}

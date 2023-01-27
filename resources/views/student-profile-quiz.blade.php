@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 align="center">Select Quiz</h2>


                </div>

                <div class="card-body">

                    @if (session('status'))

                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{route('quiz-select-for-student-profile-answer')}}" method="post">
                        @csrf


                        <div class="row">
                            <div class="form-group col-md-6 offset-3">
                                <label for="quiz-id">Select Quiz</label>

                                <select name="quiz-id" required  class="form-control"   onchange="this.form.submit();">
                                    <option  selected disabled>--SELECT--</option>

                                    @foreach($quiz as $q)
                                    <option @if(@$quiz_id==$q->id) selected @endif value="{{$q->id}}">{{$q->name}}</option>
                                    @endforeach
                                </select>


                                <span class="text-danger">
                                    @error('quiz-id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>

                    </form>

                    <hr>

                    @if(@$quiz_id)
 <div class="col-md-12" align="center" id="start-quiz-div">
        <button class="btn btn-primary" id="start-quiz">Start Quiz</button>
        <br><br><span>   Note:- Quiz Duration is {{$quiz_duration}} minutes </span>
</div>
                    @php
                    $i=1
                    @endphp
    <div id="show-question" style="display:none">

                    <span class="timer" >Quiz Ends In <b id="timer"> {{$quiz_duration}}:00 </b> minutes</span>
                    <form action="{{route('student-response')}}" method="post"  id="student-response-form">
                        @csrf

                        <input type="hidden" name="quiz-id" value="{{$quiz_id}}">
                        @foreach($question as $ques)

                        @php
                        $for_get_answer_key=0;
                        @endphp




                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="Name">Q.{{$i}} {{ $ques->question }} ?</label><br><br>



                                <ol>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-3">

                                                <input hidden type="number" name="question-id[]" value={{$ques->id}}>
                                                <span> {{@$ques->getAnswer[$for_get_answer_key]->answer}}</span>
                                                <!-- <input  type="text" value="{{@$ques->getAnswer[$for_get_answer_key]->answer}}" name="answer-{{$ques->id}}[]"    class="form-control" required> -->
                                            </div>
                                            <div class="col-md-1">

                                                <input type="radio" value="{{$ques->getAnswer[$for_get_answer_key]->id}}" name="right-answer-{{$ques->id}}" class="radio">

                                            </div>
                                        </div>
                                    </li>

                                    <br>
                                    @php
                                    $for_get_answer_key++;
                                    @endphp

                                    <li>
                                        <div class="row">
                                            <div class="col-md-3">

                                                <span> {{@$ques->getAnswer[$for_get_answer_key]->answer}}</span>
                                            </div>
                                            <div class="col-md-1">

                                                <input type="radio" value="{{$ques->getAnswer[$for_get_answer_key]->id}}" name="right-answer-{{$ques->id}}" class="radio">

                                                <!-- <input   @if(@$ques->getAnswer[$for_get_answer_key]->is_right==1) checked  @endif  type="radio" value="1" name="right-answer-{{$ques->id}}" class="radio" required> -->
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    @php
                                    $for_get_answer_key++;
                                    @endphp
                                    <li>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <span> {{@$ques->getAnswer[$for_get_answer_key]->answer}}</span>
                                            </div>
                                            <div class="col-md-1">

                                                <input type="radio" value="{{$ques->getAnswer[$for_get_answer_key]->id}}" name="right-answer-{{$ques->id}}" class="radio">

                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    @php
                                    $for_get_answer_key++;
                                    @endphp
                                    <li>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <span> {{@$ques->getAnswer[$for_get_answer_key]->answer}}</span>
                                            </div>
                                            <div class="col-md-1">
                                                <input type="radio" value="{{$ques->getAnswer[$for_get_answer_key]->id}}" name="right-answer-{{$ques->id}}" class="radio">
                                            </div>
                                        </div>
                                    </li>
                                </ol>

                                <span class="text-danger">
                                    @error('answer')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>









                        @php
                        $i++;
                        @endphp

                        @endforeach

                        <div class="col-md-1 mt-2 offset-3">
                            <input onclick="return confirm('Are you sure to submit your response.')" type="submit" value="Submit" class="form-control">

                        </div>
                    </form>
                    <br>
   </div>
    <!-- end  show question -->
                    @endif


                </div>
            </div>
        </div>



        <!-- <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">Answer list</h2></div>


                <div class="card-body">

                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <hr>
                 <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Question</th>
                                                        <th>Answer</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                            @if(@$answer)

                            @foreach($answer as $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td>{{$a->getQuestion->question}}</td>
                                <td>{{$a->answer}}</td>


                                <td> <a  style="pointer-events:none;" href="#" class="btn btn-danger">Delete</a></td>

                            </tr>
                            @endforeach

                            @endif
                                                    </tbody>
                 </table>




                </div>
            </div>
        </div> -->
    </div>
</div>
@if(!isset($quiz_duration))

@php

$quiz_duration=30;
@endphp
@endif


<script>
    $(document).ready(function() {


function leading_zero(num){

    var length=num.toString().length;

    if(length==1){
         var new_num="0"+num;

         return new_num;

    }else{
        return num;
    }

}



$('#start-quiz').click(function(){

   $('#show-question').slideDown('slow');
   $('#start-quiz-div').slideUp('slow');
   minutes="{{$quiz_duration}}";
   seconds=60;
   total_seconds=minutes*seconds;

});

var minutes="{{$quiz_duration}}";



var seconds=60;


var total_seconds=minutes*seconds;
      minutes=Math.floor(total_seconds/60);
      seconds=total_seconds%60;
      console.log(seconds);
      console.log(minutes);


      var interval=  setInterval(function () {
            minutes=Math.floor(total_seconds/60);
            seconds=total_seconds%60;

              $('#timer').html(leading_zero(minutes)+":"+leading_zero(seconds));
              total_seconds--;

              console.log(total_seconds);
              if(total_seconds==0){

                clearInterval(interval);
                $('.timer').html('<b>Quiz Ended.</b>');

                $('#student-response-form').submit();

              }
                        },1000);




    });
</script>
@endsection
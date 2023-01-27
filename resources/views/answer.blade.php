@extends('layouts.app')


@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add Answers</h2></div>

                <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif



<form action="{{route('quiz-select-for-answer')}}" method="post">
 @csrf


<div class="row">
                        <div class="form-group col-md-6 offset-3" >
                            <label for="Name" >Select Quiz</label>

                             <select name="quiz-id" class="form-control"   onchange="this.form.submit();" >
                                    <option value="">--SELECT--</option>

                                    @foreach($quiz as $q)
                                    <option   @if(@$quiz_id==$q->id)  selected @endif    value="{{$q->id}}">{{$q->name}}</option>
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

@php
$i=1

@endphp



<form action="{{route('add-answer')}}" method="post" enctype="multipart/form-data">
@csrf


@foreach($question as $ques)

@php
$for_get_answer_key=0;
@endphp




                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Q.{{$i}}  {{ $ques->question }} ?</label><br><br>



                                    <ol>
                                        <li>
                                            <div class="row">
                                                    <div class="col-md-3">
                                                        <input hidden type="number" name="question-id[]" value={{$ques->id}} >
                                                        <input  type="text" value="{{@$ques->getAnswer[$for_get_answer_key]->answer}}" name="answer-{{$ques->id}}[]"    class="form-control" required>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input @if(@$ques->getAnswer[$for_get_answer_key]->is_right==1) checked  @endif   type="radio" value="0" name="right-answer-{{$ques->id}}" class="radio" required>
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
                                                        <input   type="text" value="{{@$ques->getAnswer[$for_get_answer_key]->answer}}"  name="answer-{{$ques->id}}[]"   class="form-control" required>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input   @if(@$ques->getAnswer[$for_get_answer_key]->is_right==1) checked  @endif  type="radio" value="1" name="right-answer-{{$ques->id}}" class="radio" required>
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
                                                        <input type="text" value="{{@$ques->getAnswer[$for_get_answer_key]->answer}}" name="answer-{{$ques->id}}[]"   @if(@$question_single) value="{{$question_single->name}}" @endif class="form-control" required>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input  @if(@$ques->getAnswer[$for_get_answer_key]->is_right==1) checked  @endif   type="radio" value="2" name="right-answer-{{$ques->id}}" class="radio" required>
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
                                                        <input  type="text" value="{{@$ques->getAnswer[$for_get_answer_key]->answer}}"  name="answer-{{$ques->id}}[]"  @if(@$question_single) value="{{$question_single->name}}" @endif class="form-control" required>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input  @if(@$ques->getAnswer[$for_get_answer_key]->is_right==1) checked  @endif  type="radio" value="3" name="right-answer-{{$ques->id}}" class="radio" required>
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

                    <div class="col-md-1 mt-2 offset-2">
                        <input type="submit"  value="Save" class="form-control" >

                    </div>
    </form>
    <br>

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



<script>
$(document).ready(function(){
    // $('.radio').click(function(){

    //        $("input:radio[name=right-answer]:checked").val(1);
    //        console.log("success");

    // });
});
</script>
@endsection

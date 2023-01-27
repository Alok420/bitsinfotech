@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <div class="card">


                <div class="card-header">
                    <h2 align="center">Select quiz</h2>
                </div>

                <div class="card-body">

                    @if (session('status'))

                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{route('quiz-select-for-student-profile-result')}}" method="post">
                        @csrf


                        <div class="row mt-4 mb-4">
                            <div class="form-group col-md-6 offset-3">

                                <select name="quiz-id" required class="form-control" onchange="this.form.submit();">
                                    <option selected disabled>--SELECT--</option>

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
                </div>

            </div>
            @if(@$quiz_select)
            <div class="card">
                <div class="card-header">
                    <h2 align="center">Your @if($for_result_heading) last @endif Result</h2>
                </div>

                <div class="card-body">


                    <div class="row">

                        <div class="col-md-4">
                            <div class="row mx-3">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <i class="fa fa-quora" style="font-size:60px;"></i>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8 offset-1 icon-info">
                                    <h4 align="left">Quiz Name</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$quiz_name}}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="row mx-3">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <i class="fa fa-slack" style="font-size:60px;"></i>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8 offset-1 icon-info">
                                    <h4 align="left">Total Questions</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$total_question}}</b></h1>
                                    <h4 align="left">Right Answer</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$score}}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="row mx-3">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <i class="fa fa-percent" style="font-size:60px;"></i>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8 offset-1 icon-info">
                                    <h4 align="left">Your Percentage</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$percentage}} %</b></h1>
                                    <h4>Result Status</h4>
                                    <hr>
                                    <h3>{!!$result_status!!}</h3>
                                </div>
                            </div>
                        </div>

                    </div>





                </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
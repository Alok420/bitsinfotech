@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add Questions</h2></div>

                <div class="card-body">



<form action="{{route('quiz-select')}}" method="post">
 @csrf
 

<div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Quiz</label>

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

                @if(@$quiz_id)
                    <form action="{{route('add-question')}}" method="post">
                    @csrf
                            <div class="row">
                                <div class="form-group col-md-12" >
                                    <label for="Name" >Question</label>
                                    <input type="text" name="question"  @if(@$quiz_single) value="{{$quiz_single->name}}" @endif class="form-control">
                                    
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <input type="hidden" type="number" name="quiz-id" value="{{$quiz_id}}" >

                            <div class="col-md-2 mt-2">
                                <input type="submit"  value="Save" class="form-control" >

                            </div>
                    </form>


                @endif
                
                    
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">Question list</h2></div>
                
            
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
                               <th>Quiz</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
@if(@$question)

@foreach($question as $q)
<tr>
    <td>{{$q->id}}</td>
    <td>{{$q->question}}</td>
    <td>{{$q->getQuiz->name}}</td>
    

    <td> <a   href="{{route('delete-question',['id'=>$q->id])}}" class="btn btn-danger">Delete</a></td>
   
</tr>
@endforeach

@endif
                        </tbody>
                 </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection

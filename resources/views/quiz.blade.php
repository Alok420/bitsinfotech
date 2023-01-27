@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add Quizzes</h2></div>

                <div class="card-body">



                    <form action="{{route('add-quiz')}}" method="post" enctype="multipart/form-data">
@csrf

@if (@$quiz_single)
<input type="hidden" name="id" value="{{$quiz_single->id}}">
@endif

                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Name</label>
                            <input type="text" name="name"  @if(@$quiz_single) value="{{$quiz_single->name}}" @endif class="form-control">
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Duration (In minutes)</label>
                            <input type="number" name="duration"  @if(@$quiz_single) value="{{$quiz_single->name}}" @endif class="form-control">

                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Subject</label>

                             <select name="subject-id" class="form-control">
                                <option value="">--SELECT--</option>

                                @foreach($subject as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                             </select>

                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>



                    <div class="col-md-2 mt-2">
                        <input type="submit"  value="Save" class="form-control" >

                    </div>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">Quizzes list</h2></div>
                
            
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
                                <th>Quiz Name</th>
                                <th>Duration</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
@if(@$quiz)

@foreach($quiz as $q)
<tr>
    <td>{{$q->id}}</td>
    <td>{{$q->name}}</td>
    <td>{{$q->duration}} minutes</td>
    <td>{{$q->getSubject->name}}</td>

    <td> <a   href="{{route('delete-quiz',['id'=>$q->id])}}" class="btn btn-danger">Delete</a></td>
    
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

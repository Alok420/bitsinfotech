@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">   <h2 align="center">Student Course</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <hr>

                        <form action="{{route('add-student-course')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Student</label>
                                     <select name="student-id" class="form-control">
                                        <option value="">--Select--</option>

                                        @foreach($student as $s)
                                          <option value="{{$s->id}}">{{$s->name}}</option>
                                        @endforeach

                                     </select>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Course</label>
                                     <select name="course-id" class="form-control">
                                        <option value="">--Select--</option>

                                        @foreach($course as $c)
                                          <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach

                                     </select>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>




                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                <label for="Name">Final Fees</label>
                                    <input type="number" name="final-fees" class="form-control">
                                    <span class="text-danger">
                                        @error('final-fees')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>





                            <div class="row mt-3" >




                            <div class="col-md-2 offset-1 mt-3">
                                <input type="submit" value="Save" class="form-control">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add Courses</h2></div>

                <div class="card-body">



                    <form action="{{route('add-course')}}" method="post" enctype="multipart/form-data">
@csrf

@if (@$course_single)
<input type="hidden" name="id" value="{{$course_single->id}}">
@endif

                    <div class="row">
                        <div class="form-group col-md-5 offset-1" >
                            <label for="Name" >Name</label>
                            <input type="text" name="name"  @if(@$course_single) value="{{$course_single->name}}" @endif class="form-control">
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-5" >
                            <label for="Name" >Fees</label>
                            <input type="number" name="fees"  @if(@$course_single) value="{{$course_single->fees}}" @endif  class="form-control">
                            <span class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-5 offset-1" >
                            <label for="Name" >Duration <i>(in months)</i></label>
                            <input type="number" name="duration"  @if(@$course_single) value="{{$course_single->name}}" @endif class="form-control">

                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-5" >
                            <label for="Name" >Image</label>
                            <input type="file" name="course-image"  @if(@$course_single) value="{{$course_single->fees}}" @endif  class="form-control">
                            <span class="text-danger">
                                @error('course-image')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-11 offset-1" >
                            <label for="Name" >Description</label>
                            <input type="text" name="description"  @if(@$course_single) value="{{$course_single->name}}" @endif class="form-control">

                            <span class="text-danger">
                                @error('description')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    <div class="col-md-2 offset-1 mt-2">
                        <input type="submit"  value="Save" class="form-control" >

                    </div>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">Courses list</h2></div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                <div class="card-body">
                 <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Course Name</th>
                                <th>Fees</th>

                                <th>Duration</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($course as $c)

                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->name}}</td>
                                <td>Rs. {{$c->fees}}</td>
                                <td>{{$c->duration}} months</td>
                                @php 
                                $image_path= asset("upload")."/".$c->image;
                                @endphp
                                <td> <img width="100" height="50" src="{{$image_path}}" alt="loading..."></td>
                                <td><a href="{{route('delete-course',['id'=>$c->id])}}" class="btn btn-danger">Delete</a>
                                 {{-- &nbsp;<a href="{{route('edit-course',['id'=>$c->id])}}" class="btn btn-primary">Edit</a> --}}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                 </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection

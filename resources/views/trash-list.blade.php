@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Trash List</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                        <form action="{{url('/trash-list')}}" method="get">
                              <div class="row">
                                <div class="col-md-4">
                            <input type="search" name="search" value="{{@$search}}" placeholder="Search by name..." class="form-control">
                                </div>
                                <div class="col-md-2">
                            <input type="submit" class="btn btn-primary">
                                </div>
                              </div>
                        </form><br>

                   <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Caste</th>
                        <th>Course</th>
                        <th>Gender</th>
                        <th>Photo</th>
                        <th>Action</th>
                        </tr>
                    </thead>
<tbody>


@foreach($client as $c)
    <tr>
        <td>{{$c->id}}</td>
        <td>{{$c->name}}</td>
         <td>{{$c->email}}</td>
        <td>{{$c->contact}}</td>
        <td>{{ $c->caste}}</td>
        <td>@if ($c->course_id)
             {{ $c->getCourse->name}}
             @else ---
        @endif </td>
        <td>@if($c->gender=="M"){{ "Male"}} @elseif($c->gender=="F"){{"Female"}} @endif</td>
        <td>
    @php
        $url=asset("upload/".$c->photo);

    @endphp

 <iframe src="{{$url}}" height="100px" width="100px"></iframe>

        </td>
        <td>
            <a onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" href="{{route('cfdelete',['id'=>$c->id])}}">Delete</a>
            <a  class="btn btn-primary" href="{{route('crestore',['id'=>$c->id])}}">Restore</a>
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

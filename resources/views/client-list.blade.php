@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Student List</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <div class="row">
                        <div class="col-md-10">
                        <form action="{{route('clist')}}" method="get">
                              <div class="row">
                                <div class="col-md-4">
                            <input type="search" name="search" value="{{@$search}}" placeholder="Search by name..." class="form-control">
                                </div>
                                <div class="col-md-2">
                            <input type="submit" class="btn btn-primary">
                                </div>
                              </div>
                        </form>
                    </div>

                </div>
                        <br>

                   <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Caste</th>
                        <th>Course</th>
                        <th>Batch</th>
                        <th>City</th>
                        <th>Gender</th>
                        <th>Hobbies</th>
                        <th>Photo</th>
                        <th>Action</th>
                        </tr>
                    </thead>
<tbody>

@foreach($student as $c)
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
        <td>

            @if ($c->batch_id)
            {{ $c->getBatch->shift}}
            @else ---
       @endif
     </td>
     <td>

        {{@$c->getCity->name}}
     </td>
        <td>@if($c->gender=="M"){{ "Male"}} @elseif($c->gender=="F"){{"Female"}} @endif</td>

        <td>
            @if ($c->hobbies)

            <ul>

            @php
                $hobbies=explode(",",$c->hobbies);
                foreach($hobbies as $h){
                  echo "<li>".$h."</li>";
                }
            @endphp
            </ul>
            @endif
        </td>
        <td>
    @php
        $url=asset("upload/".$c->photo);

    @endphp

 <img   src="{{$url}}" height="100" width="100"></img>

        </td>
        <td>
            <a  class="btn btn-danger" href="{{route('cdelete',['id'=>$c->id])}}">

                Trash</a>
            <a  class="btn btn-primary" href="{{route('cedit',['id'=>$c->id])}}">Edit</a>
        </td>
    </tr>
    @endforeach
</tbody>
                   </table>
                   @if (!@$search)


                   <div class="col-md-12">

                     {{$student->links()}}
                   </div>
                   @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

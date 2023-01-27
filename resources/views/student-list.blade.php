@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">{{$heading}}</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <div class="row">

                </div>
                        <br>

                   <table class="table table-bordered table-striped">

                    <thead>
                        <tr>

                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>


                        <th>Gender</th>
                        <th>Course</th>
                        <th>Status</th>


                        </tr>
                    </thead>
<tbody>

@foreach($student as $s)
    <tr>



        <td>{{$s->id}}</td>
        <td>{{$s->name}}</td>
         <td>{{$s->email}}</td>
        <td>{{$s->contact}}</td>




     </td>

        <td>@if($s->gender=="M"){{ "Male"}} @elseif($s->gender=="F"){{"Female"}} @endif</td>
        <td><a href="{{route('show-student-course',['id'=>$s->id])}}" class="fa fa-eye" style="text-decoration:none;"></a></td>
<td>@if($s->status==1){{ "Active"}} @elseif($s->status==0){{"Not Active"}} @endif</td>


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

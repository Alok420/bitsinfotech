@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Dashboard</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                         <a href="{{route('slist')}}" style="text-decoration:none;">
                            <div class="row mx-3">
                                <div class="col-md-3 col-sm-3 col-xs-3 icon">
                                    <i class="fa fa-users" style="font-size:60px;"></i>
                                  </div>
                                  <div class="col-md-8 col-sm-8 col-xs-8 offset-1 icon-info">
                                    <h4 align="left">Total Students</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$total_student}}</b></h1>
                                 </div>
                                </div>
                        </a>

                        </div>

                        <div class="col-md-6">

                        <a  style="text-decoration:none;" href="{{route('active-student-list')}}">
                            <div class="row mx-3">
                                <div class="col-md-3 col-sm-3 col-xs-3 icon">
                                    <i class="fa fa-users" style="font-size:60px;"></i>
                                  </div>
                                  <div class="col-md-8 col-sm-8 col-xs-8 offset-1 icon-info">
                                    <h4 align="left">Active Students</h4>
                                    <hr>
                                    <h1 align="left"><b>{{$total_active_student}}</b></h1>
                                 </div>
                                </div>
                         </a>

                        </div>


                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection

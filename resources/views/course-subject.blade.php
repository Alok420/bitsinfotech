@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">   <h2 align="center">Course Subject</h2></div>

                    <div class="card-body">
                       

                        <hr>

                        <form action="{{route('add-course-subject')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
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


                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Subject</label>
                                     <select name="subject-id" class="form-control">
                                        <option value="">--Select--</option>

                                        @foreach($subject as $s)
                                          <option value="{{$s->id}}">{{$s->name}}</option>
                                        @endforeach

                                     </select>
                                    <span class="text-danger">
                                        @error('subject-id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>










                         



                            <div class="col-md-2 offset-1 mt-3">
                                <input type="submit" value="Save" class="form-control">

                            </div>

                        </form>
                    </div>
                </div>
              
            </div>

           


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">   <h2 align="center">Courses Subjects List</h2></div>

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
                                <th>Course Name</th>
                                <th>Course Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach($course as $c)

                        <tr>
                            
                            <td>{{$c->id}}</td>
                         
                            <td>{{$c->name}}</td>
                            <td>
                            <ol>
                          
                          

                                @foreach($c->get_Course_Subject as $s)
                                

                              
                                   
                                   <li>{{$s->getSubject->name}}</li>
                              
                                 

                                  

                             
                                
                                @endforeach
                           
                             
                             </ol>


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

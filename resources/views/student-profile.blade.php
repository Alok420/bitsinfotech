@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Student Profile</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <div class="row mt-3">
                        <div class="col-md-4" align="center">
                            <i class="fa fa-user" style="font-size:100px;" ></i>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Name
                                </div>
                                <div class="col-md-6 profile-content">
                                    {{$student->name}}

                                </div>



                            </div>
                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Email
                                </div>
                                <div class="col-md-6 profile-content">
                                    {{$student->email}}

                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Contact
                                </div>
                                <div class="col-md-6 profile-content">
                                    {{$student->contact}}

                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Gender
                                </div>
                                <div class="col-md-6 profile-content">
                                     @if($student->gender=='M')
                                     Male
                                     @else
                                     Female
                                     @endif

                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Qualification
                                </div>
                                <div class="col-md-6 profile-content">
                                   {{$student->qualification}}

                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Start Date
                                </div>
                                <div class="col-md-6 profile-content">
                                   {{my_format_date($student->start_date)}}

                                </div>



                            </div>


                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    End Date
                                </div>
                                <div class="col-md-6 profile-content">
                                   {{my_format_date($student->end_date)}}

                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6 profile-label">
                                    Status
                                </div>
                                <div class="col-md-6 profile-content">
                                    @if($student->status==1)
                                    Active
                                    @else
                                    Inactive
                                    @endif

                                </div>



                            </div>



                        </div>



                </div>
                <!-- main row end -->
                        <br>







                </div>
            </div>
<!-- card end -->

            <div class="card">
                <div class="card-header"><h2 align="center">Student Course</h2></div>

                <div class="card-body">

                <table class="table table-bordered table-striped">

<thead>
    <tr>

    <th>Id</th>
    <th>Course Name</th>
    <th>Course Subjects</th>

    </tr>
</thead>
<tbody>

@foreach($student_course as $sc)
<tr>
     <td>{{$sc->id}}</td>
    <td> {{$sc->getCourse->name}}</td>
    <td>
        @foreach($sc->getCourse->get_Course_Subject as $s)




                                <li>{{$s->getSubject->name}}</li>







                             @endforeach
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

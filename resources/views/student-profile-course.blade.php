@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 align="center">Course List</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div id="my-alert" class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">

                        </div>
                        <br>

                        <table id="myTable" class="table table-bordered table-striped">

                            <thead>
                                <tr>

                                    <th>Id</th>
                                    <th>Course Name</th>
                                    <th>Subject</th>
                                    <th>Course Fees</th>
                                    <th>Paid Fees</th>
                                    <th>Due Fees</th>





                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($user_course_paid as $c)
                                    @php
                                        
                                        $paid = 0;
                                    @endphp
                                    <tr>



                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->getCourse->name }}</td>
                                        <td>
                                            @foreach ($c->getCourse->get_Course_Subject as $s)
                                                <li> {{ $s->getSubject->name }} </li>
                                            @endforeach
                                        </td>
                                        <td> {{ price($c->final_fees) }} </td>

                                        <td>
                                            <a style="text-decoration:none"
                                                href="{{ route('student-profile-transaction') }}"> {{ $c->paid_fees }}<a />
                                        </td>
                                        <td>
                                            {{ $c->final_fees - $c->paid_fees }}

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

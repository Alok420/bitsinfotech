@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 align="center">Student : <b> {{ $student_name }}</b> </h2>
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
                                    <th>Course Subjects</th>
                                    <th>Course Fees</th>




                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($course as $c)
                                    @isset($c->getCourse)
                                        <tr>
                                            <td>{{ $c->id }}</td>
                                            <td>{{ $c->getCourse->name }}</td>
                                            <td>
                                                @if (count($c->getCourse->get_Course_Subject))
                                                    @foreach ($c->getCourse->get_Course_Subject as $subject)
                                                        <li>{{ $subject->getSubject->name }}</li>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td> Rs. {{ $c->final_fees }} </td>
                                            </td>
                                        </tr>
                                    @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

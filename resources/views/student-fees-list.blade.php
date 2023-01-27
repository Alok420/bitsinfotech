@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Paid Fees List</h2></div>

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
                        <th>Student Name</th>
                        <th>Amount</th>
                        <th>Payment Date</th>


                        <th>Method</th>
                        
                         
                        </tr>
                    </thead>
<tbody>
@foreach($student_fees as $sf)
 <tr>
    <td>{{$sf->id}}</td>
    <td>{{$sf->getStudent->name}}</td>
    <td>{{$sf->amount}}</td>
    <td>{{$sf->date}}</td>
    <td>{{$sf->method}}</td>
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

@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 align="left">Student Name : {{$student_name}}</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <div class="row">
                
              <table class="table table-bordered table-striped">

<thead>
    
    <tr>
         
    <th>Id</th>

    <th>Course Name</th>
     
    <th>Final Fees</th>
     

    
    
 
    </tr>
</thead>
<tbody>
@php
 $i=1;
 $total_fees_required=0;
 @endphp
 @foreach($course as $c)

 <tr>
    <td>{{$i}}</td>
    <td>{{$c->getCourse->name}}</td>
    <td>Rs. {{$c->final_fees}}</td>

    
 </tr>
 @php 
 $i++;
 $total_fees_required+=$c->final_fees;
 @endphp
 @endforeach
</tbody>
</table>

<h5 align="right">Total Fees : {{ $total_fees_required }}</h5>
<h5 align="right">Total Fees Paid : {{ $total_fees_paid }}</h5>
                </div>
                        

                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

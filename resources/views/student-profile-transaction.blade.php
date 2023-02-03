@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 align="center">Your Transactions</h2>
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
                                    <th>Amount Paid</th>
                                    <th>Payment Method</th>
                                    <th>Payment date</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $paid = 0;
                                @endphp
                                @foreach ($transaction as $t)
                                    @isset($t->getCourse)
                                        <tr>
                                            <td>{{ $t->id }}</td>
                                            <td>{{ $t->getCourse->name }}</td>

                                            <td> {{ price($t->amount) }} </td>
                                            @php
                                                $paid += $t->amount;
                                            @endphp
                                            <td>
                                                {{ $t->method }}
                                            </td>
                                            <td>
                                                {{ my_format_date($t->date) }}
                                            </td>
                                            <td>
                                                <a href="{{route('student-invoice',['id'=>$t->id ]) }}" class="btn btn-success">Invoice</a>
                                            </td>
                                        </tr>
                                    @endisset
                                @endforeach
                            </tbody>
                        </table>

                        <h6 align="right">Total Paid : <b> {{ price($paid) }} </b></h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">User List</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <br>

                   <table id="myTable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>



                        </tr>
                    </thead>
<tbody>

@foreach($user as $u)
    <tr>
        <td>{{$u->id}}</td>
        <td>{{$u->name}}</td>
         <td>{{$u->email}}</td>









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

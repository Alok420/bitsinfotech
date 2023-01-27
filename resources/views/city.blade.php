@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add City</h2></div>

                <div class="card-body">



                    <form action="{{route('add-city')}}" method="post">
@csrf

@if (@$city_single)
<input type="hidden" name="id" value="{{$city_single->id}}">
@endif

                    <div class="row">
                        <div class="form-group col-md-11 offset-1" >
                            <label for="Name" >Name</label>
                            <input type="text" name="name"  @if(@$city_single) value="{{$city_single->name}}" @endif class="form-control">
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-11 offset-1" >
                            <label for="Name" >State</label>
                            <input type="text" name="state"  @if(@$city_single) value="{{$city_single->state}}" @endif class="form-control">
                            <span class="text-danger">
                                @error('state')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>


                    </div>



                    <div class="col-md-2 offset-1 mt-2">
                        <input type="submit"  value="Save" class="form-control" >

                    </div>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">City list</h2></div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                <div class="card-body">
                 <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>City Name</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($city as $c)

                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->name}}</td>

                                <td><a href="{{route('delete-city',['id'=>$c->id])}}" class="btn btn-danger">Delete</a>
                                 &nbsp;<a href="{{route('edit-city',['id'=>$c->id])}}" class="btn btn-primary">Edit</a>
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

@extends('layouts.app')

@section('content')
<div class="container my-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add subjects</h2></div>

                <div class="card-body">



                    <form action="{{route('add-subject')}}" method="post" enctype="multipart/form-data">
@csrf

@if (@$subject_single)
<input type="hidden" name="id" value="{{$subject_single->id}}">
@endif

                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Name</label>
                            <input type="text" name="name"  @if(@$subject_single) value="{{$subject_single->name}}" @endif class="form-control">
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Description</label>
                            <input type="text" name="description"  @if(@$subject_single) value="{{$subject_single->name}}" @endif class="form-control">

                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>



                    <div class="col-md-2 mt-2">
                        <input type="submit"  value="Save" class="form-control" >

                    </div>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card">

                <div class="card-header"> <h2 align="center">Subjects list</h2></div>
                
            
                <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <hr>
                 <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Subject Name</th>
                                <th>Description</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

@foreach($subject as $s)
<tr>
    <td>{{$s->id}}</td>
    <td>{{$s->name}}</td>
    <td>{{$s->description}}</td>
  

    <td><a  class="btn btn-danger" href="{{route('subject-delete',['id'=>$s->id])}}"> Delete</a></td>

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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <h2 align="center">Add Batches</h2></div>

                <div class="card-body">




                    <form action="{{route('add-batch')}}" method="post">
@csrf

                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="Name" >Shift Name</label>
                            <input type="text" name="name"   class="form-control">
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

                <div class="card-header"> <h2 align="center">Batches list</h2></div>
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
                                <th>Shift</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($batch as $b)

                            <tr>
                                <td>{{$b->id}}</td>
                                <td>{{$b->shift}}</td>

                                <td><a href="{{route('delete-batch',['id'=>$b->id])}}" class="btn btn-primary">Delete</a></td>
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

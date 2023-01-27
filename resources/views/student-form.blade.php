@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">   <h2 align="center">{{ $heading }}</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <hr>

                        <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Name</label>
                                    <input type="text" name="name" value="{{ @$client->name }}" class="form-control">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="Name">Email</label>
                                    <input type="email" name="email" value="{{ @$client->email }}" class="form-control">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Contact</label>
                                    <input type="number" maxlength="10" name="contact" value="{{ @$client->contact }}"
                                        class="form-control">
                                    <span class="text-danger">
                                        @error('contact')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="Name">Address</label>
                                    <textarea name="address"  cols="20" rows="1" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Start Date</label>
                                    <input type="date"   name="start-date" value="{{ @$client->contact }}"
                                        class="form-control">
                                    <span class="text-danger">
                                        @error('start-date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="Name">End Date</label>
                                    <input type="date" name="end-date" class="form-control">
                                    <span class="text-danger">
                                        @error('end-date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mt-1">

                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Qualification</label>
                                    <input type="text"   name="qualification" value="{{ @$client->qualification }}"
                                        class="form-control">
                                    <span class="text-danger">
                                        @error('qualification')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-5 mt-3">
                                    <label>Gender</label>&nbsp;&nbsp;&nbsp;

                                    <input @if (@$client->gender == 'M') checked @endif type="radio" name="gender"
                                        id="male" value="M">
                                    <label for="male"><i>Male</i></label>&nbsp;&nbsp;
                                    <input @if (@$client->gender == 'F') checked @endif id="female" type="radio"
                                        name="gender" value="F">
                                    <label for="female"><i>Female</i></label>
                                    <span class="text-danger">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Status</label>
                                     <select name="status" class="form-control">
                                        <option value="">--SELECT--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                     </select>
                                    <span class="text-danger">
                                        @error('contact')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="Name">User</label>
                                            <select name="user-id" class="form-control">
                                               
                                                @if(count($user))
                                                <option value="">--SELECT--</option>
                                                @else
                                                <option value="">No Data Found</option>
                                                @endif

                                                @foreach($user as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                                @endforeach
                                               
                                            </select>
                                    <span class="text-danger">
                                        @error('user-id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                           
                            
                   




                            <div class="row mt-3" >




                            <div class="col-md-2 offset-1 mt-3">
                                <input type="submit" value="Save" class="form-control">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

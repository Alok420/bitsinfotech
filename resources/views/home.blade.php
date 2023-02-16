@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (empty($heading))
                            <h1>{{ 'Account Created successfully, Contact to admin ' }}</h1>

                            @php
                                die();
                            @endphp
                        @else
                            <p>Your data is here!</p>
                        @endif
                        <h2 align="center">{{ $heading }}</h2>
                    </div>

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
                                    <label for="Name">Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="form-group col-md-5 offset-1">
                                    <label for="Name">Course</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($course as $c)
                                            <option @if (@$client->course_id == $c->id) selected @endif
                                                value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach

                                    </select>
                                    <i id="course-italic"></i>
                                    <span class="text-danger">
                                        @error('course')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="Name">Caste</label>
                                    <select name="caste" id="caste" class="form-control">
                                        <option value="">--select--</option>
                                        <option @if (@$client->caste == 'gernal') selected @endif value="gernal">Gernal
                                        </option>
                                        <option @if (@$client->caste == 'obc') selected @endif value="obc">Obc
                                        </option>
                                        <option @if (@$client->caste == 'sc') selected @endif value="sc">Sc</option>
                                        <option @if (@$client->caste == 'st') selected @endif value="st">St</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('caste')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-md-5 offset-1">
                                    <label for="city">City</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($city as $ci)
                                            <option @if (@$client->city_id == $ci->id) selected @endif
                                                value="{{ $ci->id }}">{{ $ci->name }}</option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-5">
                                    <label for="Name">Batch</label>
                                    <select name="batch" id="batch" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($batch as $b)
                                            <option @if (@$client->batch_id == $b->id) selected @endif
                                                value="{{ $b->id }}">{{ $b->shift }}</option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger">
                                        @error('course')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="form-group col-md-5 offset-1">
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

                                <div class="form-group col-md-6">
                                    <label for="hobbies">Hobbies</label><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i>Indoor Games</i>&nbsp;



                                            @php
                                                if (@$client->hobbies) {
                                                    $hobbies = explode(',', $client->hobbies);
                                                } else {
                                                    $hobbies = [];
                                                }
                                            @endphp
                                            <input @if (in_array('Indoor', $hobbies)) checked @endif type="checkbox"
                                                value="Indoor" name="hobby[]">
                                        </div>
                                        <div class="col-md-4">
                                            <i>Outdoor Games</i>&nbsp;
                                            <input @if (in_array('Outdoor', $hobbies)) checked @endif type="checkbox"
                                                value="Outdoor" name="hobby[]">
                                        </div>
                                        <div class="col-md-3">
                                            <i>Other</i>&nbsp;
                                            <input @if (in_array('Other', $hobbies)) checked @endif type="checkbox"
                                                value="Other" name="hobby[]">
                                        </div>
                                        <span class="text-danger">
                                            @error('hobby')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 offset-1 mt-3">
                                <input type="submit" value="Save" class="form-control">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#course").change(function() {

                var a = $("#course").val();
                if (a) {
                    $.ajax({
                        url: "{{ url('getfees') }}",
                        type: "get",
                        data: {
                            id: a
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $("#course-italic").html(data);
                        }



                    });
                } else {

                    $("#course-italic").html("");

                }
            })

        })
    </script>
@endsection

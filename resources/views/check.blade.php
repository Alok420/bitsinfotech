@extends('layouts.app')

@section('content')
    <div class="container my-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">   <h2 align="center">on check page</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <hr>
                        <img   src="{{url('upload/1669026334-slaravel.jpg')}}" height="600px" width="800px"></img>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#course").change(function() {

                var a = $("#course").val();
                if(a){
                $.ajax({
                    url: "{{url('getfees')}}",
                    type: "get",
                    data: {id:a},
                    dataType:"JSON",
                    success:function(data){
                             $("#course-italic").html(data);
                    }



                });
            }else{

                $("#course-italic").html("");

            }
            })

        })
    </script>
@endsection

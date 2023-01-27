
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 align="center">Client List</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="my-alert" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                   <table border="2" cellspacing="0" cellpadding="4">

                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Caste</th>
                        <th>Course</th>
                        <th>Gender</th>


                        </tr>
                    </thead>
<tbody>


@foreach($client as $c)
    <tr>
        <td>{{$c->id}}</td>
        <td>{{$c->name}}</td>
         <td>{{$c->email}}</td>
        <td>{{$c->contact}}</td>
        <td>{{ $c->caste}}</td>
        <td>@if ($c->course_id)
             {{ $c->getCourse->name}}
             @else ---
        @endif </td>
        <td>@if($c->gender=="M"){{ "Male"}} @elseif($c->gender=="F"){{"Female"}} @endif</td>


    </tr>
    @endforeach
</tbody>
                   </table>


                </div>
            </div>
        </div>
    </div>
</div>

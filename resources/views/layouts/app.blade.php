<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <style>
        td {
            text-align: center;
        }

        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm"
            style="position:fixed; z-index:1; width:100%;     background:rgb(61, 46, 46);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav me-auto">

  
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                                <a class="nav-link"> {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



        <input type="checkbox" id="check" />

        <div class="accordion">


            <div class="sidebar-fixed">
                <header> <label for="check" id="show-label"><i class="fa fa-bars" id="show-nav"></i></label>
                </header>
                <ul>

                    @if (Auth::user()->role == 0)
                        <li class="collapsed" data-toggle="collapse" data-target=".sub-dashboard"> <i
                                class="fa fa-user"></i> </li>
                        <li class="collapsed" data-toggle="collapse" data-target=".sub-dashboard"> <i
                                class="fa fa-graduation-cap"></i> </li>

                        <li class="collapsed" data-toggle="collapse" data-target=".sub-profile-quiz"> <i
                                class="fa fa-quora"></i> </li>


                        <ul class="sub-ul sub-profile-quiz collapse @if ($nav == 'quiz') show @endif"
                            data-parent=".accordion">

                            <li> <i class="fa fa-question"></i></li>
                            <li> <i class="fa fa-slack"></i></li>



                        </ul>
                    @elseif(Auth::user()->role == 1)
                        <li class="collapsed" data-toggle="collapse" data-target=".sub-dashboard"> <i
                                class="fa fa-dashboard"></i> </li>



                        <li class="collapsed" data-toggle="collapse" data-target=".sub-student"> <i
                                class="fa fa-users"></i> </li>
                        <ul class="sub-ul sub-student collapse @if ($nav == 'student') show @endif "
                            data-parent=".accordion">
                            <li><i class="fa fa-edit"></i></li>
                            <li><i class="fa fa-users"></i></li>
                            <li><i class="fa fa-users"></i></li>
                            <li><i class="fa fa-graduation-cap"></i></li>
                            <li><i class="fa fa-rupee"></i></li>
                            <li><i class="fa fa-rupee"></i></li>


                        </ul>

                        <li class="collapsed" data-toggle="collapse" data-target=".sub-course"> <i
                                class="fa fa-graduation-cap"></i> </li>
                        <ul class="sub-ul sub-course collapse @if ($nav == 'course') show @endif "
                            data-parent=".accordion">
                            <li><i class="fa fa-edit"></i></li>
                            <li><i class="fa fa-edit"></i></li>
                        </ul>

                        <li class="collapsed" data-toggle="collapse" data-target=".sub-subject"> <i
                                class="fa fa-graduation-cap"></i> </li>
                        <ul class="sub-ul sub-subject collapse @if ($nav == 'subject') show @endif "
                            data-parent=".accordion">
                            <li><i class="fa fa-edit"></i></li>


                        </ul>

                        <li class="collapsed" data-toggle="collapse" data-target=".sub-quiz"> <i
                                class="fa fa-quora"></i> </li>
                        <ul class="sub-ul sub-quiz collapse @if ($nav == 'quiz') show @endif "
                            data-parent=".accordion">
                            <li><i class="fa fa-quora"></i></li>

                            <li><i class="fa fa-question"></i></li>
                            <li><i class="fa fa-slack"></i></li>
                        </ul>

                    @endif

                </ul>

            </div>



            <div class="sidebar-content">
                <header>Navigation&nbsp;
                    <label for="check" id="hide-label"><i class="fa fa-times" id="hide-nav"></i></label>

                </header>
                <ul>

                    @if (Auth::user()->role == 0)
                        <li class=" @if ($nav != 'student-dashboard') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-profile"><a @if ($basename == 'profile') class="active" @endif
                                href="{{ route('student-profile') }}">Your Profile</a> </li>


                        <li class=" @if ($nav != 'student-profile-course') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-profile"><a @if ($basename == 'course') class="active" @endif
                                href="{{ route('student-profile-course') }}">Course List</a> </li>

                        <li class=" @if ($nav != 'quiz') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-profile-quiz">Quiz <span><i class="fa fa-caret-down"></i></span> </li>


                        <ul class="sub-ul sub-profile-quiz collapse @if ($nav == 'quiz') show @endif"
                            data-parent=".accordion">

                            <li> <a @if ($basename == 'student-profile-quiz') class="active" @endif
                                    href="{{ route('student-profile-quiz') }}">Quizes</a> </li>
                            <li> <a @if ($basename == 'student-profile-result') class="active" @endif
                                    href="{{ route('student-profile-result') }}">Your Results</a> </li>



                        </ul>
                    @elseif(Auth::user()->role == 1)
                        <li class=" @if ($nav != 'dashboard') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-dashboard"><a @if ($basename == 'home') class="active" @endif
                                href="{{ route('dashboard') }}">Dashboard</a> </li>




                        <li class=" @if ($nav != 'student') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-student">Student
                            <span><i class="fa fa-caret-down"></i></span>
                        </li>

                        <ul class="sub-ul sub-student collapse  @if ($nav == 'student') show @endif "
                            data-parent=".accordion">
                            <li><a @if ($basename == 'add-form') class="active" @endif
                                    href="{{ route('student-form') }}">Student Form</a></li>
                            <li><a @if ($basename == 'slist') class="active" @endif
                                    href="{{ route('slist') }}">All Student List</a></li>
                            <li><a @if ($basename == 'active-student-list') class="active" @endif
                                    href="{{ route('active-student-list') }}">Active Student List</a></li>

                            <li><a @if ($basename == 'scourse') class="active" @endif
                                    href="{{ route('scourse') }}">Student Course</a></li>
                            <li><a @if ($basename == 'sfees') class="active" @endif
                                    href="{{ route('sfees') }}">Student Fees</a></li>
                            <li><a @if ($basename == 'sfees-list') class="active" @endif
                                    href="{{ route('sfees-list') }}">Paid Fees List</a></li>
                        </ul>


                        <li class=" @if ($nav != 'course') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-course">Course <span> <i class="fa fa-caret-down"></i></span> </li>

                        <ul class="sub-ul sub-course collapse @if ($nav == 'course') show @endif"
                            data-parent=".accordion">
                            <li> <a @if ($basename == 'course-form') class="active" @endif
                                    href="{{ route('course-form') }}">Course</a></li>
                            <li> <a @if ($basename == 'course-subject') class="active" @endif
                                    href="{{ route('course-subject') }}">Course Subject</a></li>
                        </ul>


                        <li class=" @if ($nav != 'subject') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-subject">Subject <span> <i class="fa fa-caret-down"></i></span> </li>

                        <ul class="sub-ul sub-subject collapse @if ($nav == 'subject') show @endif"
                            data-parent=".accordion">
                            <li> <a @if ($basename == 'add-subject') class="active" @endif
                                    href="{{ route('subject') }}">Add Subject</a></li>
                        </ul>

                        <li class=" @if ($nav != 'quiz') collapsed @endif" data-toggle="collapse"
                            data-target=".sub-quiz">Quiz <span> <i class="fa fa-caret-down"></i></span> </li>

                        <ul class="sub-ul sub-quiz collapse @if ($nav == 'quiz') show @endif"
                            data-parent=".accordion">
                            <li> <a @if ($basename == 'addquiz') class="active" @endif
                                    href="{{ route('quiz') }}">Add Quiz</a></li>
                            <li> <a @if ($basename == 'question') class="active" @endif
                                    href="{{ route('questions') }}">Add Questions</a></li>
                            <li> <a @if ($basename == 'answer') class="active" @endif
                                    href="{{ route('answer') }}">Add Answers</a></li>
                        </ul>
                    @endif

                </ul>

               </ul>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/magnific-popup.js') }}"></script>


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('.image-link').magnificPopup({
                type: 'image'
            });


            setTimeout(() => {
                $(".alert").slideUp("slow");

            }, 4000);



        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    
</body>

</html>

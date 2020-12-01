<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Tasks</title>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-12">
           <nav class="navbar navbar-expand-sm bg-light w-100 mr-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                     <a href="{{ url('/') }}" class="nav-link">Main</a> 
                </li>
                <li class="nav-item">
                     <a href="{{ url('/statuses') }}" class="nav-link">Statuses</a> 
                </li>
                <li class="nav-item">
                     <a href="{{ url('/groups') }}" class="nav-link">Groups</a> 
                </li>
                <li class="nav-item">
                     <a href="{{ url('/ajax') }}" class="nav-link">Ajax</a> 
                </li>

            </ul>

            <div class="navbar-nav ml-auto ">
                @if(Auth::check())
                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                        {{ Auth::user()->name }}                            
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                          {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary btn-sm px-4 mr-2" 
                        href="{{ url('register') }}">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary btn-sm px-4 mr-2" 
                        href="{{ url('login') }}">Login</a>
                    </li>
                @endif
            </div>
           </nav>
        </div>
    </div>
</div>


@yield('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{ asset(url('js/script.js')) }}"></script>
</body>
</html>
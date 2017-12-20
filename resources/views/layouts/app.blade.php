<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bancamérica</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://bootswatch.com/3/spacelab/bootstrap.css" >
</head>
<body>
    <div id="app" style= "background-color: rgba(0, 0, 0, 0.0001);">
        <nav class="navbar navbar-primary ">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Bancamérica
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (auth()->check())
                        <form class="navbar-form">
                            <div class="form-group">
                                <select id="list-of-requirements" class="form-control">
                                    @foreach (auth()->user()->list_of_requirements as $requirement)
                                    <option value="{{ $requirement->id }}" @if($requirement->id==auth()->user()->selected_requirement_id) selected @endif>{{ $requirement->name }}</option>
                                    @endforeach
                                </select>
                            </div>                     
                        </form>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container">
    <div class="row">
        <div class="col-md-3">            
            @include('includes.menu')
        </div>
        <div class="col-md-9">  

            @yield('content')          

        </div>
    </div>
   </div>

        
    </div>

    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>    
    @yield('scripts')
   
</body>
</html>

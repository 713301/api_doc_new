<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'API Documentation App') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{url('vendor/json_beautifier/beautify-json.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default custom-blue navbar-static-top @if (!Auth::check()) full-width @endif">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if (Auth::check())
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-default navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav margin-left-off">
                        <li>
                            @if (!Auth::check())
                                <a class="white-text font-2x bold" href="{{ url('/') }}">
                                    {{ config('app.name', 'API Documentation App') }}
                                </a>
                            @endif
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a class="white-text" href="{{ route('login') }}">Login</a></li>
                        <li><a class="white-text" href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle white-text" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
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
                    @endif
                </ul>


            </div>
        </div>
    </nav>
    @yield('content')
    <div class="loading full-width full-height fixed high-z-index">
        <img class="animated bounceIn" src="{{asset('images/loader.gif')}}">
    </div>
</div>
<script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('vendor/json_beautifier/jquery.beautify-json.js')}}"></script>
<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
<script type="text/javascript" src="{{asset('vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").niceScroll({
            cursorcolor: '#53619d',
            cursorwidth: 4,
            cursorborder: 'none'
        });

        $('#sidebarCollapse').on('click', function () {
            $(".navbar-static-top").toggleClass("full-width animated");
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in animated');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });

        $('.json-container').beautifyJSON({
            type: "plain",
    // highlight JSON on mouse hover
    hoverable: true,
    // make nested nodes collapsible
    collapsible: true,
    // enable colors
    color: true
});
    });
</script>
</body>
</html>
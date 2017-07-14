<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'API Documentation App') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,700" rel="stylesheet">    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{url('css/dropin.css')}}">
</head>
<body>
    <div class="content" id="app">
        <h1>{{ config('app.name', 'API Documentation App') }}</h1>
        <p>A documentation app for api nerds</p>
        <span class="bottom-root">Developed and Maintained by iMPP Developers</span>
        <canvas></canvas>
        
        @if (Route::has('login'))
        <div class="router-links">
            @if (Auth::check())
                <a class="links" href="{{ url('/home') }}">Home</a>
            @else
                <a class="links" href="{{ url('/login') }}">Login</a>
                <a class="links" href="{{ url('/register') }}">get registered</a>
            @endif
        </div>
        @endif
    </div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript" src="{{url('js/particle.js')}}"></script>
    <script type="text/javascript" src="{{url('js/app.js')}}"></script>
</body>
</html>

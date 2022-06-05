<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
	    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, width=device-width, height=device-height, viewport-fit=cover">

        <title>Let's play Snap</title>

        <!-- Favicon -->
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon.ico') }}" />

        <!-- Framework Imports -->
        <link type="text/css" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">

        <!-- Main CSS Styling -->
        <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    </head>
    <body class="container">
        @yield('content')
    </body>

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    
    @yield('scripts')
</html>

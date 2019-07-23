<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- vendor css -->
    <link href="{{asset('starlight/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('starlight/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
<link rel="stylesheet" href="{{asset('starlight/css/starlight.css')}}">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      @yield('content')
    </div><!-- d-flex -->

    <script src="{{asset('starlight/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('starlight/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('starlight/lib/bootstrap/bootstrap.js')}}"></script>
    @include('sweetalert::alert')`
    @yield('scripts')

  </body>
</html>

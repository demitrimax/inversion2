<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Scripts -->

    <link href="{{asset('appzia/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('appzia/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('appzia/css/style.css')}}" rel="stylesheet" type="text/css">
    @yield('css')
</head>

<body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">
          @yield('content')
        </div>

          <!-- jQuery  -->
              <script src="{{asset('appzia/js/jquery.min.js')}}"></script>
              <script src="{{asset('appzia/js/bootstrap.min.js')}}"></script>
              <script src="{{asset('appzia/js/modernizr.min.js')}}"></script>
              <script src="{{asset('appzia/js/detect.js')}}"></script>
              <script src="{{asset('appzia/js/fastclick.js')}}"></script>
              <script src="{{asset('appzia/js/jquery.slimscroll.js')}}"></script>
              <script src="{{asset('appzia/js/jquery.blockUI.js')}}"></script>
              <script src="{{asset('appzia/js/waves.js')}}"></script>
              <script src="{{asset('appzia/js/wow.min.js')}}"></script>
              <script src="{{asset('appzia/js/jquery.nicescroll.js')}}"></script>
              <script src="{{asset('appzia/js/jquery.scrollTo.min.js')}}"></script>

              <script src="{{asset('appzia/js/app.js')}}"></script>
              @yield('scripts')
          </body>
          </html>

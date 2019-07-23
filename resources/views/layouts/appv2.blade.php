<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
<link href="{{asset('starlight/lib/Ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">

<!-- Starlight CSS -->
<link rel="stylesheet" href="{{asset('starlight/css/starlight.css')}}">

    @yield('css')
</head>

<body>
  <!-- ########## START: LEFT PANEL ########## -->
 <div class="sl-logo"><a href=""><i class="icon ion-md-planet"></i> INVERSIÓN</a></div>
 <div class="sl-sideleft">
   <div class="input-group input-group-search">
     <input type="search" name="search" class="form-control" placeholder="Search">
     <span class="input-group-btn">
       <button class="btn"><i class="fa fa-search"></i></button>
     </span><!-- input-group-btn -->
   </div><!-- input-group -->

   <label class="sidebar-label">Navegación</label>
   <div class="sl-sideleft-menu">
     @include('layouts.menuv2')
   </div><!-- sl-sideleft-menu -->

   <br>
 </div><!-- sl-sideleft -->
 <!-- ########## END: LEFT PANEL ########## -->

 <!-- ########## START: HEAD PANEL ########## -->
@include('layouts.rightheader')
 <!-- ########## END: HEAD PANEL ########## -->

 <!-- ########## START: RIGHT PANEL ########## -->
@include('layouts.rightpanel')
 <!-- ########## END: RIGHT PANEL ########## --->

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
   @yield('breadcrum')

   <div class="sl-pagebody">

     @yield('content')

   </div><!-- sl-pagebody -->

   <footer class="sl-footer">
     <div class="footer-left">
       <div class="mg-b-2">Copyright &copy; 2019. Veritas Software. All Rights Reserved.</div>
       <div>Made by ThemePixels.</div>
     </div>
     <div class="footer-right d-flex align-items-center">
      
     </div>
   </footer>
 </div><!-- sl-mainpanel -->
 <!-- ########## END: MAIN PANEL ########## -->

 <script src="{{asset('starlight/lib/jquery/jquery.js')}}"></script>
 <script src="{{asset('starlight/lib/popper.js/popper.js')}}"></script>
 <script src="{{asset('starlight/lib/bootstrap/bootstrap.js')}}"></script>
 <script src="{{asset('starlight/lib/jquery-ui/jquery-ui.js')}}"></script>
 <script src="{{asset('starlight/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
 <script src="{{asset('starlight/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
 <script src="{{asset('starlight/lib/d3/d3.js')}}"></script>
 <script src="{{asset('starlight/lib/rickshaw/rickshaw.min.js')}}"></script>
 <script src="{{asset('starlight/lib/chart.js/Chart.js')}}"></script>
 <script src="{{asset('starlight/lib/Flot/jquery.flot.js')}}"></script>
 <script src="{{asset('starlight/lib/Flot/jquery.flot.pie.js')}}"></script>
 <script src="{{asset('starlight/lib/Flot/jquery.flot.resize.js')}}"></script>
 <script src="{{asset('starlight/lib/flot-spline/jquery.flot.spline.js')}}"></script>

 <script src="{{asset('starlight/js/starlight.js')}}"></script>
 <script src="{{asset('starlight/js/ResizeSensor.js')}}"></script>

 @include('sweetalert::alert')`
 @yield('scripts')
  </body>
</html>

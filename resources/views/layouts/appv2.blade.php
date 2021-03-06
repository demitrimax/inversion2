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
<!--
<link href="{{asset('starlight/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">

<!-- Starlight CSS -->
<link rel="stylesheet" href="{{asset('starlight/css/starlight.css')}}">

    @yield('css')
    @stack('css')
</head>

<body>
  <!-- ########## START: LEFT PANEL ########## -->
 <div class="sl-logo"><a href=""><i class="icon ion-md-planet"></i> INVERSIÓN</a></div>
 <div class="sl-sideleft">
   {!! Form::open(['route'=>'busqueda.total'])!!}
   <div class="input-group input-group-search">
     <input type="search" name="search" class="form-control" placeholder="Buscar">
     <span class="input-group-btn">
       <button class="btn"><i class="fa fa-search"></i></button>
     </span><!-- input-group-btn -->
   </div><!-- input-group -->
   {!! Form::close()!!}

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

   <footer class="sl-footer d-print-none">
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



 <script src="{{asset('starlight/js/starlight.js')}}"></script>
 <script src="{{asset('starlight/js/ResizeSensor.js')}}"></script>


<script src="{{asset('starlight/lib/highlightjs/highlight.pack.js')}}"></script>



 @include('sweetalert::alert')`
 @yield('scripts')
 @stack('scripts')
  </body>
</html>

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

      <link href="{{asset('appzia/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @yield('css')
</head>
<body class="fixed-left">
    <!-- Begin page -->
  <div id="wrapper">

      <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{url('/')}}" class="logo"><img src="{{asset('logos/logo.png')}}" alt="logo-img"></a>
                <a href="{{url('/')}}" class="logo-sm"><img src="{{asset('logos/logo_sm.png')}}" alt="logo-img"></a>
            </div>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="ion-navicon"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>
                    <form class="navbar-form pull-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control search-bar" placeholder="Buscar...">
                        </div>
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </form>

                    <ul class="nav navbar-nav navbar-right pull-right">
                        @include('layouts.notificaciones')
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <img src="{{asset('appzia/images/users/avatar-1.jpg')}}" alt="user-img" class="img-circle">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"> Perfil</a></li>
                                <li><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Configuración </a></li>
                                <li><a href="javascript:void(0)"> Bloqueo</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"> Cerrar Sesión</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->
  <!-- ========== Left Sidebar Start ========== -->
  @include('layouts.sidebar')
  <!-- Left Sidebar End -->
  <div class="content-page">
                  <!-- Start content -->
                  <div class="content">

                                @yield('content')

                  </div> <!-- content -->

                  <footer class="footer">
                       © 2019 - Todos los derechos reservados <a href="http://moisesaguilarweb.com">Veritas Software</a>.
                  </footer>

    </div>
    <!-- End Right content here -->


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
          <script src="{{asset('appzia/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
          @include('sweetalert::alert')`
          @yield('scripts')
        </div>
        <!-- END wrapper -->
  </body>
</html>

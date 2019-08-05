<div class="sl-header">
  <div class="sl-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="ion-ios-menu"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="ion-ios-menu"></i></a></div>
  </div><!-- sl-header-left -->
  <div class="sl-header-right">
    <nav class="nav">
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name">{{Auth::user()->name}}<span class="hidden-md-down"> </span></span>
          <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('starlight/img/img3.jpg') }}" class="wd-32 rounded-circle" alt="">
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href="{{route('profile')}}"><i class="icon ion-ios-contact"></i> Editar Perfil</a></li>
            <li><a href=""><i class="icon ion-ios-cog"></i> Opciones</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><i class="icon ion-ios-power"></i> Cerrar Sesión</a></li>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
    <div class="navicon-right">
      <a id="btnRightMenu" href="" class="pos-relative">
        <i class="icon ion-ios-notifications-outline"></i>
        <!-- start: if statement -->
        @if($vartareas->count()>0)
        <span class="square-8 bg-danger"></span>
        @endif
        <!-- end: if statement -->
      </a>
    </div><!-- navicon-right -->
  </div><!-- sl-header-right -->
</div><!-- sl-header -->

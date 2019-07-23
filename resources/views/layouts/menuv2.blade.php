<a href="{{url('/home')}}" class="sl-menu-link {{ Request::is('home*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-desktop tx-22"></i>
    <span class="menu-item-label">Dashboard</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@can('cproyectos-list')
<a href="{!! route('cproyectos.index') !!}" class="sl-menu-link {{ Request::is('cproyectos*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-filing tx-20"></i>
    <span class="menu-item-label">Proyectos</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan
@can('empresas-list')
<a href="{!! route('empresas.index') !!}" class="sl-menu-link {{ Request::is('empresas*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-briefcase tx-20"></i>
    <span class="menu-item-label">Empresas</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan


@can('creditos-list')
<a href="{!! route('creditos.index') !!}" class="sl-menu-link {{ Request::is('creditos*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-cash tx-20"></i>
    <span class="menu-item-label">Créditos</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan

@can('proveedores-list')
<a href="{!! route('proveedores.index') !!}" class="sl-menu-link {{ Request::is('proveedores*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-barcode tx-20"></i>
    <span class="menu-item-label">Proveedores</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan

@php
if( Request::is('efinancieras*') || Request::is('clasificas*') || Request::is('bancos*') ||
      Request::is('bcuentas*') || Request::is('metpagos*')) {
    $varActive = "active show-sub";
} else {
  $varActive = "";
}
@endphp

<a href="#" class="sl-menu-link {{$varActive}}">
  <div class="sl-menu-item">
    <i class="menu-item-icon ion-ios-journal tx-20"></i>
    <span class="menu-item-label">Catálogos</span>
    <i class="menu-item-arrow fa fa-angle-down"></i>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
<ul class="sl-menu-sub nav flex-column">
  @can('efinancieras-list')
  <li class="nav-item"><a href="{!! route('efinancieras.index') !!}" class="nav-link {{ Request::is('efinancieras*') ? 'active' : '' }}">Financieras</a></li>
  @endcan
  @can('clasificas-list')
  <li class="nav-item"><a href="{!! route('clasificas.index') !!}" class="nav-link {{ Request::is('clasificas*') ? 'active' : '' }}">Categorías</a></li>
  @endcan
  @can('bancos-list')
  <li class="nav-item"><a href="{!! route('bancos.index') !!}" class="nav-link {{ Request::is('bancos*') ? 'active' : '' }}">Bancos</a></li>
  @endcan
  @can('bcuentas-list')
  <li class="nav-item"><a href="{!! route('bcuentas.index') !!}" class="nav-link {{ Request::is('bcuentas*') ? 'active' : '' }}">Cuentas</a></li>
  @endcan
  @can('metpagos-list')
  <li class="nav-item"><a href="{!! route('metpagos.index') !!}" class="nav-link {{ Request::is('metpagos*') ? 'active' : '' }}">Métodos de Pago</a></li>
  @endcan
  @can('coddivisas-list')
  <li class="nav-item"><a href="{!! route('coddivisas.index') !!}" class="nav-link {{ Request::is('coddivisas*') ? 'active' : '' }}">Códigos de Divisa</a></li>
  @endcan
</ul>
  @hasrole('administrador')
  @php
  if( Request::is('user*') || Request::is('permissions*') || Request::is('roles*')  ) {
      $varActive = "active show-sub";
  } else {
    $varActive = "";
  }
  @endphp
<a href="#" class="sl-menu-link {{$varActive}}">
  <div class="sl-menu-item">
    <i class="menu-item-icon ion-ios-settings tx-20"></i>
    <span class="menu-item-label">Configuración</span>
    <i class="menu-item-arrow fa fa-angle-down"></i>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
<ul class="sl-menu-sub nav flex-column">
  <li class="nav-item"><a href="{{url('user')}}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">Usuarios</a></li>
  <li class="nav-item"><a href="{{url('roles')}}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">Roles</a></li>
  <li class="nav-item"><a href="{{url('permissions')}}" class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">Permisos</a></li>
</ul>
@endhasrole

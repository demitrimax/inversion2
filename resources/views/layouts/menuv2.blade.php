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
@php
if( Request::is('productos*') || Request::is('categorias*') || Request::is('bodegas*')
  || Request::is('clientes*') || Request::is('invoperacions*') || Request::is('inventario/entrada*')
  || Request::is('inventario/salida*') || Request::is('invproveedores*') || Request::is('facturara*')
  || Request::is('inventario*')) {
    $varActive = "active show-sub";
} else {
  $varActive = "";
}
@endphp
<a href="#" class="sl-menu-link {{$varActive}}">
<div class="sl-menu-item">
  <i class="menu-item-icon ion-ios-cube tx-20"></i>
  <span class="menu-item-label">Inventarios</span>
  <i class="menu-item-arrow fa fa-angle-down"></i>
</div><!-- menu-item -->
</a><!-- sl-menu-link -->
<ul class="sl-menu-sub nav flex-column">

  @can('inventario-salida')
  <li class="nav-item"><a href="{!! route('inventario.salida') !!}" class="nav-link {{ Request::is('inventario/salida*') ? 'active' : '' }}">Salidas</a></li>
  @endcan
  @can('inventario-entrada')
  <li class="nav-item"><a href="{!! route('inventario.entrada') !!}" class="nav-link {{ Request::is('inventario/entrada*') ? 'active' : '' }}">Entradas</a></li>
  @endcan

  @can('invoperacions-list')
  <li class="nav-item"><a href="{!! route('invoperacions.index') !!}" class="nav-link {{ Request::is('invoperacions*') ? 'active' : '' }}">Operación</a></li>
  @endcan
  @can('productos-list')
  <li class="nav-item"><a href="{!! route('productos.index') !!}" class="nav-link {{ Request::is('productos*') ? 'active' : '' }}">Productos</a></li>
  @endcan
  @can('categorias-list')
  <li class="nav-item"><a href="{!! route('categorias.index') !!}" class="nav-link {{ Request::is('categorias*') ? 'active' : '' }}">Categorias de Productos</a></li>
  @endcan
  @can('bodegas-list')
  <li class="nav-item"><a href="{!! route('bodegas.index') !!}" class="nav-link {{ Request::is('bodegas*') ? 'active' : '' }}">Bodegas</a></li>
  @endcan
  @can('clientes-list')
  <li class="nav-item"><a href="{!! route('clientes.index') !!}" class="nav-link {{ Request::is('clientes*') ? 'active' : '' }}">Clientes</a></li>
  @endcan
  @can('invproveedores-list')
  <li class="nav-item"><a href="{!! route('invproveedores.index') !!}" class="nav-link {{ Request::is('invproveedores*') ? 'active' : '' }}">Proveedores</a></li>
  @endcan
  @can('facturaras-list')
  <li class="nav-item"><a href="{!! route('facturaras.index') !!}" class="nav-link {{ Request::is('facturaras*') ? 'active' : '' }}">Empresas</a></li>
  @endcan
  @can('inventario')
  <li class="nav-item"><a href="{!! url('inventario/informe/ver1') !!}" class="nav-link {{ Request::is('inventario/informe*') ? 'active' : '' }}">Reporte Inventario</a></li>
  @endcan

</ul>

@can('proveedores-list')
<a href="{!! route('proveedores.index') !!}" class="sl-menu-link {{ Request::is('proveedores*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-barcode tx-20"></i>
    <span class="menu-item-label">Proveedores</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan

@can('tareas-list')
<a href="{!! route('tareas.index') !!}" class="sl-menu-link {{ Request::is('tareas*') ? 'active' : '' }}">
  <div class="sl-menu-item">
    <i class="menu-item-icon icon ion-ios-checkmark-circle tx-20"></i>
    <span class="menu-item-label">Tareas</span>
  </div><!-- menu-item -->
</a><!-- sl-menu-link -->
@endcan

@php
if( Request::is('efinancieras*') || Request::is('clasificas*') || Request::is('bancos*') ||
      Request::is('bcuentas*') || Request::is('metpagos*') || Request::is('operaciones*') || Request::is('subclasificas*')
      || Request::is('facturas*') || Request::is('coddivisas*') || Request::is('minventarios*') ) {
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
  @can('subclasificas-list')
  <li class="nav-item"><a href="{!! route('subclasificas.index') !!}" class="nav-link {{ Request::is('subclasificas*') ? 'active' : '' }}">SubCategorías</a></li>
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
  @can('operaciones-list')
  <li class="nav-item"><a href="{!! route('operaciones.index') !!}" class="nav-link {{ Request::is('operaciones*') ? 'active' : '' }}">Operaciones</a></li>
  @endcan
  @can('facturas-list')
  <li class="nav-item"><a href="{!! route('facturas.index') !!}" class="nav-link {{ Request::is('facturas*') ? 'active' : '' }}">Facturas</a></li>
  @endcan
  @can('minventarios-list')
  <li class="nav-item">  <a href="{!! route('minventarios.index') !!}" class="nav-link {{ Request::is('minventarios*') ? 'active' : '' }}"><span>Mi Inventario</span></a> </li>
  @endcan
</ul>

  @hasrole('administrador')
  @php
  if( Request::is('user*') || Request::is('permissions*') || Request::is('roles*') || Request::is('logs*') || Request::is('activity*') || Request::is('backup*')) {
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
  @role('administrador')
  <li class="nav-item"><a href="{{url('otroslogs')}}" class="nav-link {{ Request::is('logs*') ? 'active' : '' }}">Logs del Sistema</a></li>
  @endrole
  <li class="nav-item"><a href="{{url('activity')}}" class="nav-link {{ Request::is('activity*') ? 'active' : '' }}">Activity Logs</a></li>
  <li class="nav-item"><a href="{{url('backup')}}" class="nav-link {{ Request::is('backup*') ? 'active' : '' }}">Copias de Seguridad</a></li>
</ul>
@endhasrole

<li class="menu-title">Menu</li>
<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{{url('home')}}" class="waves-effect"><i class="mdi mdi-home"></i><span> Dashboard <span class="badge badge-primary pull-right">1</span></span></a>
</li>

@can('cproyectos-list')
<li class="{{ Request::is('cproyectos*') ? 'active' : '' }}">
    <a href="{!! route('cproyectos.index') !!}" class="waves-effect"><i class="mdi mdi-assistant"></i><span> Proyectos</span></a>
</li>
@endcan
@can('empresas-list')
<li class="{{ Request::is('empresas*') ? 'active' : '' }}">
    <a href="{!! route('empresas.index') !!}"><i class="ion ion-planet"></i><span> Empresas</span></a>
</li>
@endcan
@can('creditos-list')
<li class="{{ Request::is('creditos*') ? 'active' : '' }}">
    <a href="{!! route('creditos.index') !!}" class="waves-effect"><i class="ion ion-social-usd"></i><span> Creditos</span></a>
</li>
@endcan

<li class="has_sub">
  @php
  if( Request::is('catpaisdivisions*') || Request::is('catareaciudads*') || Request::is('contratistas*')  ) {
      $varActive = "active";
  } else {
    $varActive = "";
  }
  @endphp
    <a href="javascript:void(0);" class="waves-effect {{$varActive}}"><i class="mdi mdi-assistant"></i><span> Catálogos </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
    <ul class="list-unstyled">
        @can('efinancieras-list')
        <li class="{{ Request::is('efinancieras*') ? 'active' : '' }}">
              <a href="{!! route('efinancieras.index') !!}"><i class="fa fa-edit"></i><span> Financieras</span></a>
        </li>
        @endcan
        @can('clasificas-list')
        <li class="{{ Request::is('clasificas*') ? 'active' : '' }}">
            <a href="{!! route('clasificas.index') !!}"><i class="fa fa-edit"></i><span> Categorias</span></a>
        </li>
        @endcan
        @can('bancos-list')
        <li class="{{ Request::is('bancos*') ? 'active' : '' }}">
            <a href="{!! route('bancos.index') !!}"><i class="fa fa-edit"></i><span>Bancos</span></a>
        </li>
        @endcan
        @can('bcuentas-list')
        <li class="{{ Request::is('bcuentas*') ? 'active' : '' }}">
            <a href="{!! route('bcuentas.index') !!}"><i class="fa fa-edit"></i><span>Cuentas</span></a>
        </li>
        @endcan
        @can('metpagos-list')
        <li class="{{ Request::is('metpagos*') ? 'active' : '' }}">
            <a href="{!! route('metpagos.index') !!}"><i class="fa fa-edit"></i><span>Métodos de pagos</span></a>
        </li>
        @endcan
    </ul>
</li>

<li class="has_sub">
  @hasrole('administrador')
    @php
    if( Request::is('user*') || Request::is('permissions*') || Request::is('roles*')  ) {
        $varActive = "active";
    } else {
      $varActive = "";
    }
    @endphp
    <a href="javascript:void(0);" class="waves-effect {{$varActive}}"><i class="mdi mdi-album"></i> <span> Configuración </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
    <ul class="list-unstyled">
        <li class="{{ Request::is('user*') ? 'active' : '' }}"><a href="{{url('user')}}">Usuarios</a></li>
        <li class="{{ Request::is('roles*') ? 'active' : '' }}"><a href="{{url('roles')}}">Roles</a></li>
        <li class="{{ Request::is('permissions*') ? 'active' : '' }}"><a href="{{url('permissions')}}">Permisos</a></li>
    </ul>
</li>
@endhasrole
<li class="{{ Request::is('proveedores*') ? 'active' : '' }}">
    <a href="{!! route('proveedores.index') !!}"><i class="fa fa-edit"></i><span>Proveedores</span></a>
</li>

<li class="{{ Request::is('coddivisas*') ? 'active' : '' }}">
    <a href="{!! route('coddivisas.index') !!}"><i class="fa fa-edit"></i><span>Coddivisas</span></a>
</li>


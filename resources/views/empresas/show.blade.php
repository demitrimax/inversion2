@extends('layouts.appv2')
@section('title',config('app.name').' | Empresa '.$empresas->nombre )
@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/empresas')}}">Empresas</a>
  <span class="breadcrumb-item active">{{$empresas->nombre}}</span>
</nav>
@endsection

@section('content')

<div class="clearfix"></div>

@include('flash::message')

<div class="clearfix"></div>

    <div class="content">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                  <div class="col-md-6">
                    @include('empresas.show_fields')
                  </div>

              <div class="col-md-6">

                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                            Cuentas
                          </a>
                        </h6>
                      </div><!-- card-header -->

                      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" style="">
                        <div class="card-body">
                            @include('empresas.cuentas')
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" role="tab" id="headingTwo">
                        <h6 class="mg-b-0">
                          <a class="transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Inversión a Proyectos
                          </a>
                        </h6>
                      </div>
                      <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                        <div class="card-body">
                          @include('empresas.movimientos')
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" role="tab" id="headingThree">
                        <h6 class="mg-b-0">
                          <a class="transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Operaciones
                          </a>
                        </h6>
                      </div>
                      <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" style="">
                        <div class="card-body">
                          @include('empresas.operaciones')
                      </div><!-- collapse -->
                    </div><!-- card -->
                  </div>

            </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card-footer tx-center bg-gray-300">
                  <a href="{!! route('empresas.index') !!}" class="btn btn-primary">Regresar</a>
                </div>
  </div>
</div>
@endsection

@section('scripts')
  @stack('scripts')
@endsection

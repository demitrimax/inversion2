<div class="col-xl-6">
  <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
    <h6 class="card-body-title">Detalles del Proyecto</h6>
    <p class="mg-b-20 mg-sm-b-30">Información detallada del proyecto de inversión.</p>
    <div class="row">
      <label class="col-sm-4 form-control-label">Número:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! $cproyectos->folio !!}
      </div>
    </div><!-- row -->
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">Nombre:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! $cproyectos->nombre !!}
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">Descripción:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! $cproyectos->descripcion !!}
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">Fecha de Inicio:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! $cproyectos->finicio->format('d-m-Y') !!}
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">Categoría:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! $cproyectos->clasifica->nombre !!}
      </div>
    </div>
    <div class="form-layout-footer mg-t-30">
      <a href="{!! route('cproyectos.index') !!}" class="btn btn-primary">Regresar</a>
    </div><!-- form-layout-footer -->
  </div><!-- card -->
</div><!-- col-6 -->

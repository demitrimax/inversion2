<div class="panel panel-color panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Registro de Avances</h3>
    </div>
    <div class="panel-body">
      @if($tareas->avances->count()>0)
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Concepto</th>
            <th>Avance</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tareas->avances as $avance)
          <tr>
            <td>
              <button type="button" class="btn btn-info btn-xs"
              data-container="body" title="" data-toggle="popover"
              data-popover-color="default"
              data-trigger="focus" data-placement="top"
              data-content="{{$avance->comentario}}" title="Observaciones">
              <i class="fa fa-info"></i>
              </button>
              @if($avance->comentarios->count() > 0)
              <button type="button" class="btn btn-warning btn-xs" onclick="Comentarios({{$avance->id}})"><i class="fa fa-comments-o"></i></button>
              @endif
            {{$avance->concepto}}
            </td>
            <td>{{$avance->avancepor}}%</td>
            <td>
              @can('tareas-comentario')
              <button type="button" class="btn btn-primary btn-xs waves-effect waves-light" onclick="ComentarioAvance({{$avance->id}})">Comentario</button>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif

      @can('registrar-avances')
        @if($tareas->avance_porc < 100)
          @if($tareas->user_id == Auth::user()->id)
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#RegistroAvances">Registrar Avance</button>
          @endif
        @endif
      @endcan
    </div>
</div>

@can('registrar-avances')
<!--  Modal content for the above example -->
  <div id="RegistroAvances" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myLargeModalLabel">Registrar Avance</h4>
              </div>
              {!! Form::open(['route' => 'tareas.avanceregistro']) !!}
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('concepto', 'Concepto:') !!}
                        {!! Form::text('concepto', null, ['class' => 'form-control maxlen', 'required', 'maxlength' => '35']) !!}
                        {!! Form::hidden('tarea_id', $tareas->id)!!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('comentario', 'Comentarios:') !!}
                        {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
                    </div>
                    @php
                    $porcentaje = null;
                      if(isset($tareas->avance_porc)){
                        $porcentaje = $tareas->avance_porc;
                      }
                    @endphp

                    <div class="form-group">
                    {!! Form::label('avancepor', 'Avance:') !!}
                    <div class="input-group bootstrap-touchspin">
                        {!! Form::number('avancepor', $porcentaje, ['class' => 'form-control', 'required', 'max' => '100', 'min'=>$porcentaje]) !!}
                        <span class="input-group-addon bootstrap-touchspin-postfix">%</span>
                    </div>
                  </div>


                </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar Avance</button>
            </div>
            {!! Form::close() !!}
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  @endcan

@can('tareas-comentario')
  <div id="ComentarioTarea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="TareasComentarios" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Comentario de Avance</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              {!! Form::open(['route' => 'tareas.avance.comentario']) !!}
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('Comentario', 'Comentario:') !!}
                        {!! Form::textarea('comentario', null, ['class' => 'form-control', 'required']) !!}
                        {!! Form::hidden('tarea_id', $tareas->id, ['id'=>'tarea_id'])!!}
                        {!! Form::hidden('avance_id', null, ['id'=>'avance_id'])!!}
                    </div>

                </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar Comentario</button>
            </div>
            {!! Form::close() !!}
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  @endcan

  @section('scripts')
  <script>
    function ComentarioAvance(id){
      $("#ComentarioTarea").modal("show");
      $("#avance_id").val(id);

    }
    function Comentarios(id){

      Swal.fire({
          title: 'Comentarios',
          type: 'info',
          html:
            '<b>Usuario 1</b>, ' +
            'Mi comentario es el siguiente ' +
            '',
          showCloseButton: true,
        })
    }
    </script>

  @endsection

@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
<link href="{{asset('starlight/lib/medium-editor/default.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">


@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control texteditor']) !!}
</div>

@php
//conversion de fecha
$fechavencimiento = null;

if(isset($tareas->vencimiento)){
    $fechavencimiento = $tareas->vencimiento->format('Y-m-d');
}

@endphp

<!-- Vencimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vencimiento', 'Vencimiento:') !!}<button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Formato de Fecha" data-content="Escriba la fecha en formato yyyy-mm-dd o utilice el selector de fecha."><i class="fa fa-question"></i></button>
    {!! Form::text('vencimiento', $fechavencimiento, ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-here','id'=>'fecha', 'id'=>'fcreacion', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'required', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Usuario:') !!}
    {!! Form::select('user_id', $usuarios, null, ['class' => 'form-control', 'placeholder'=>'Seleccione un usuario', 'required']) !!}
</div>


<!-- Avance Porc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avance_porc', 'Porcentaje de Avance:') !!}
    {!! Form::number('avance_porc', null, ['class' => 'form-control', 'max'=>'100', 'min'=>'0']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tareas.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script src="{{asset('table_fixed_header/vendor/select2/select2.min.js')}}"></script>
<script>
     //Bootstrap-MaxLength
        $('.maxlen').maxlength();

        $(function () {
          $('[data-toggle="popover"]').popover()
        })

            $('.select2').select2();

</script>
<script src="{{asset('starlight/lib/medium-editor/medium-editor.js')}}"></script>
<script src="{{asset('starlight/lib/summernote/summernote-bs4.min.js')}}"></script>
<script>
      $(function(){
        'use strict';

        // Summernote editor
        $('.texteditor').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>

@endsection

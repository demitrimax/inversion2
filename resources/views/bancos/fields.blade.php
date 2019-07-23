@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!} <span class="required">*</span>
    {!! Form::text('nombre', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
</div>

<!-- Denominacionsocial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('denominacionsocial', 'Denominación Social:') !!}
    {!! Form::text('denominacionsocial', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'150']) !!}
</div>

<!-- Nombrecorto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombrecorto', 'Nombre Corto:') !!}
    {!! Form::text('nombrecorto', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'10']) !!}
</div>

<!-- Rfc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('RFC', 'RFC:') !!}
    {!! Form::text('RFC', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'13']) !!}
</div>

<!-- Entidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Entidad', 'Entidad:') !!}
    {!! Form::text('Entidad', null, ['class' => 'form-control maxlen', 'maxlength'=>'10']) !!}
</div>

<!-- Grupofinancierto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grupofinancierto', 'Grupo Financiero:') !!}
    {!! Form::text('grupofinancierto', null, ['class' => 'form-control', 'maxlength'=>'120']) !!}
</div>

<!-- Paginainternet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paginainternet', 'Pagina de internet:') !!}
    {!! Form::text('paginainternet', null, ['class' => 'form-control', 'maxlength'=>'120']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength'=>'120']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bancos.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script>
     //Bootstrap-MaxLength
        $('.maxlen').maxlength();
</script>

@endsection

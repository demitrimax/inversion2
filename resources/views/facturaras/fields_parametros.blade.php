@card(['title'=>'Parametros de la Plantilla', 'color'=>'success'])

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plantilla[cliente]', 'Celda Cliente:') !!}
    {!! Form::text('plantilla[cliente]', null, ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plantilla[rfc]', 'Celda RFC:') !!}
    {!! Form::text('plantilla[rfc]', null, ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plantilla[domicilio]', 'Celda Domicilio:') !!}
    {!! Form::text('plantilla[domicilio]', null, ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
</div>

@endcard

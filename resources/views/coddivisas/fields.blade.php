<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Código de Divisa:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'maxlength'=>'3']) !!}
</div>
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength'=>'50']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('coddivisas.index') !!}" class="btn btn-default">Cancelar</a>
</div>

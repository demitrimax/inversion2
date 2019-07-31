<!-- Clasifica Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clasifica_id', 'Clasificación:') !!}
    {!! Form::select('clasifica_id', $categorias, null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength'=>'50' ]) !!}
    <!-- 'oninput'=>'this.value = this.value.toUpperCase()' -->
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('subclasificas.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

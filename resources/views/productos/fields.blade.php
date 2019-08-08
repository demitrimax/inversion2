@section('css')
<link href="{{asset('starlight/lib/medium-editor/default.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control texteditor']) !!}
</div>

<!-- Imagen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imagen', 'Imagen:') !!}
    {!! Form::file('imagen', null, ['class' => 'form-control']) !!}
</div>

<!-- Barcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barcode', 'Barcode:') !!}
    {!! Form::text('barcode', null, ['class' => 'form-control maxlen', 'maxlength'=>'50']) !!}
</div>

<!-- Categoria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoria_id', 'Categoría:') !!}
    {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
</div>

<!-- Inventariable Field -->
<div class="form-group col-sm-6">
    <label class="ckbox checkbox-inline">
        {!! Form::hidden('inventariable', 0) !!}
        {!! Form::checkbox('inventariable', '1', null) !!} <span>Inventariable</span>
    </label>
</div>

<!-- Umedida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('umedida', 'Unidad de medida:') !!}
    {!! Form::text('umedida', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'30']) !!}
</div>

<!-- Stock Min Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_min', 'Stock Min:') !!}
    {!! Form::number('stock_min', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productos.index') !!}" class="btn btn-default">Cancelar</a>
</div>

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
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
      //Bootstrap-MaxLength
         $('.maxlen').maxlength();
</script>
@endsection

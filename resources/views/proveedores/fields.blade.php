@section('css')
<link href="{{asset('starlight/lib/medium-editor/default.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Rfc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rfc', 'RFC:') !!}
    {!! Form::text('rfc', null, ['class' => 'form-control']) !!}
</div>

<!-- Domicilio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('domicilio', 'Domicilio:') !!}
    {!! Form::text('domicilio', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>

<!-- Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contacto', 'Contacto:') !!}
    {!! Form::text('contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Contacto Field -->
<div class="form-group col-sm-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control texteditor']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('proveedores.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
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

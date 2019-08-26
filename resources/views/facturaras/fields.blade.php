@section('css')
<link href="{{asset('starlight/lib/medium-editor/default.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">

@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!} <span class="text-danger">*</span>
    {!! Form::text('nombre', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'150']) !!}
</div>

<!-- Rfc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rfc', 'RFC:') !!} <span class="text-danger">*</span>
    {!! Form::text('rfc', null, ['class' => 'form-control', 'required', 'maxlength'=>'13']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('altaproveedor', 0) !!}
    {!! Form::checkbox('altaproveedor', null, 0) !!}
    {!! Form::label('proveedor', 'Alta como proveedor:') !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-12">

    {!! Form::label('plantilla_remision', 'Plantilla de Formato de Remisión:') !!}
    {!! Form::textarea('plantilla_remision', null, ['class'=>'form-control texteditor']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('facturaras.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('starlight/lib/medium-editor/medium-editor.js')}}"></script>
<script src="{{asset('starlight/lib/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('starlight/lib/jquery-ui/jquery-ui.js')}}"></script>
<script>
      $(function(){
        'use strict';

        // Summernote editor
        $('.texteditor').summernote({
          height: 150,
          tooltip: true,
          toolbar: [
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['color', ['color']],
                    ['insert', ['picture', 'link', 'video', 'table','filebrowser', 'hr']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['undo', ['undo', 'redo']],
                    ['codeview', ['codeview']],
                ],
        })
      });
      //Bootstrap-MaxLength
         $('.maxlen').maxlength();
         $(function () {
           $('[data-toggle="popover"]').popover()
         })
</script>
@endsection

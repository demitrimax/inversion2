@extends('layouts.appv2')
@section('title',config('app.name').' | Minventarios' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Mi nventario</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('minventarios.show_fields')


                </div>
                <a href="{!! route('minventarios.index') !!}" class="btn btn-secondary">Regresar</a>
                <a href="{!! route('minventarios.edit', [$minventario->id]) !!}" class="btn btn-primary">Editar</a>
                {!! Form::open(['route' => ['minventarios.destroy', $minventario->id], 'method' => 'delete', 'id'=>'form'.$minventario->id]) !!}

                    @can('minventarios-delete')
                    {!! Form::button('Borrar', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($minventario->id)"]) !!}
                    @endcan

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function ConfirmDelete(id) {
  swal.fire({
        title: '¿Estás seguro?',
        text: 'Estás seguro de borrar este elemento.',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
        }).then((result) => {
  if (result.value) {
    document.forms['form'+id].submit();
  }
})
}
</script>
@endpush

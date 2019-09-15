<div class="col-md-6">
  <div class="card card-primary">
    <div class="card-header card-header-default">
        <h3 class="card-title">Subcategorías </h3>
    </div>
      <div class="card-body">
        @if($clasifica->subcategorias->count() > 0)
        <table class="table table-responsive" id="clasificas-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($clasifica->subcategorias as $subcategoria)
                <tr>
                    <td><a href="{!! route('subclasificas.show', [$subcategoria->id]) !!}">{!! $subcategoria->nombre !!}</a></td>
                    <td>{!! $subcategoria->descripcion !!}</td>
                    <td>
                        {!! Form::open(['route' => ['subclasificas.destroy', $subcategoria->id], 'method' => 'delete', 'id'=>'form'.$subcategoria->id]) !!}
                        <div class='btn-group'>
                            <a href="{!! route('subclasificas.show', [$subcategoria->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                            @can('subclasificas-edit')
                            <a href="{!! route('subclasificas.edit', [$subcategoria->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                            @endcan
                            @can('subclasificas-delete')
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($subcategoria->id)"]) !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        No existen subcategorías para esta categoría.
        @endif
        @can('subclasificas-create')
         <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('subclasificas.create') !!}">Agregar Nueva SubCategoría</a>
        @endcan
      </div>
  </div>
</div>

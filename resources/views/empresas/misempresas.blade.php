

          <div class="row">
            @foreach($empresas as $empresa)
            <div class="col-md">
              <div class="card bd-0">
                <img class="card-img img-fluid" src="{{$empresa->logoempresa ? asset($empresa->url_logo) : asset('starlight/img/img11.jpg')}}" alt="Image">
                <div class="card-img-overlay pd-30 d-flex align-items-start flex-column">
                  <h6 class="tx-white mg-b-15"><a href="{!! route('empresas.show', [$empresa->id]) !!}">{!! $empresa->nombre !!}</a></h6>
                  <p class="tx-white tx-white-7 mg-b-auto">
                    Fecha de Creación: {!! $empresa->fcreacion->format('M, Y') !!} <br>
                    Saldo al día: {{ $empresa->saldoaldia}} <p> Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet consictetur...</p>
                  <p class="mg-b-0"><a href="{!! route('empresas.show', [$empresa->id]) !!}" class="tx-white">Detalles</a></p>
                  {!! Form::open(['route' => ['empresas.destroy', $empresa->id], 'method' => 'delete', 'id'=>'form'.$empresa->id]) !!}
                  <div class='btn-group'>
                      <a href="{!! route('empresas.show', [$empresa->id]) !!}" class='btn btn-info btn-icon mg-r-5 mg-b-10'><i class="far fa-eye"></i></a>
                      @can('empresas-edit')
                      <a href="{!! route('empresas.edit', [$empresa->id]) !!}" class='btn btn-primary btn-icon mg-r-5 mg-b-10'><i class="far fa-edit"></i></a>
                      @endcan
                      @can('empresas-delete')
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-icon mg-r-5 mg-b-10', 'onclick' => "ConfirmDelete($empresa->id)"]) !!}
                      @endcan
                  </div>
                  {!! Form::close() !!}
                </div><!-- card-img-overlay -->
              </div><!-- card -->
            </div><!-- col -->
            @endforeach
          </div><!-- row -->

          @section('scripts')
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
          @endsection

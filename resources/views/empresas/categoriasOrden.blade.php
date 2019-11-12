@push('css')
<link rel="stylesheet" href="{{asset('css/theme.min.css')}}" data-skin="default">

@endpush

@push('scripts')
<script src="{{asset('js/Sortable.min.js')}}"></script>
<!-- <script src="{{asset('js/jquery.nestable.min.js')}}"></script> -->
<script src="{{asset('js/theme.min.js')}}"></script>
<script>
  var sortableOptions2 = {
  group: {
    name: "sortable-list-2",
    pull: true,
    put: true,
  },
  animation: 250,
  forceFallback: true

};

var containers = null;
  containers = document.querySelectorAll(".containerCategoria");
  for (var i = 0; i < containers.length; i++) {
    new Sortable(containers[i], sortableOptions2);
  }

  // generate list JSON
  $('#guardarOrden').click(function() {
    console.log('Guardando Orden....');
    let data = {};

    var titles = $('.containerCategoria').map(function(idx, elem) {
      return {'id' : $(elem).attr('data-id'), 'orden': idx, 'empresa_id': '{{$empresas->id}}' };
    }).get();

    data['categorias'] = titles;


    // encode to JSON format
    var products_json = JSON.stringify(data,null,'\t');
    //$('#printCode').html(products_json);
    //console.log(products_json);

          $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{asset('empresa/'.$empresas->id.'/ordencategorias')}}",
                  data: titles,
                  contentType: "application/json; charset=utf-8",
                  success: function(data){
                      alert('Items added');
                  },
                  error: function(e){
                      console.log(e.message);
                  }
          });

  });
</script>

@endpush

@card(['title'=>'Categorías y Orden aplicables a la empresa', 'color'=>'primary'])

            <div class="row">
                  <!-- grid column -->
                  <div class="col-lg-6">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <div class="card-header border-bottom-0"> Orden de las Categorias </div><!-- .nestable -->
                      <div id="nestable01" class="dd" data-toggle="nestable" data-group="1" data-max-depth="5">
                        <!-- .dd-list -->
                        <ol class="dd-list">
                          @foreach($empresas->categorias as $clasifica)
                          <li class="dd-item containerCategoria" data-id="{{$clasifica->id}}">
                            <div class="dd-handle">
                              <span class="drag-indicator"></span>
                              <div> {{$clasifica->nombre}} </div>
                            </div>
                          </li>
                          @endforeach


                        </ol><!-- /.dd-list -->
                      </div><!-- /.nestable -->
                      <!-- .card-footer -->

                      <div class="card-footer">
                        <a id="guardarOrden" href="#" class="card-footer-item justify-content-start"><span><i class="fa fa-save mr-1"></i> Guardar Orden</span></a>
                      </div>
                      <!-- /.card-footer -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->
                  <!-- grid column -->

                  <div class="col-lg-6">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <div class="card-header border-bottom-0"> Orden Subcategorias </div><!-- .nestable -->
                      <div id="nestable02" class="dd" data-toggle="nestable" data-group="1" data-max-depth="5">
                        <!-- .dd-list -->
                        <ol class="dd-list">
                          @foreach($categorias as $clasifica)
                          <li class="dd-item" data-id="{!!$clasifica->id!!}">
                            <div class="dd-handle">
                              <span class="drag-indicator"></span>
                              <div> {{$clasifica->nombre}} </div>
                            </div>
                            <ol>
                              @foreach($subcategorias->where('clasifica_id',$clasifica->id) as $subclasifica)
                              <li class="dd-item container" data-id="{!!$subclasifica->id!!}">
                                <div class="dd-handle">
                                  <span class="drag-indicator"></span>
                                  <div> {{$subclasifica->nombre}} </div>
                                </div>
                              </li>
                              @endforeach
                            </ol>
                          </li>
                          @endforeach

                        </ol><!-- /.dd-list -->
                      </div><!-- /.nestable -->
                      <!-- .card-footer -->

                    </div><!-- /.card -->
                  </div><!-- /grid column -->
                </div>

@endcard

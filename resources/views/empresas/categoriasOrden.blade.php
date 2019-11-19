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
  containers = document.querySelectorAll(".container");
  for (var i = 0; i < containers.length; i++) {
    new Sortable(containers[i], sortableOptions2);
  }



  // generate list JSON
  $('#guardarOrden').click(function() {
    console.log('Guardando Orden....');
    let data = {};

    var titles = $('.categoriaOrden').map(function(idx, elem) {
      return {'id' : $(elem).attr('orden'), 'orden': idx, 'empresa_id': '{{$empresas->id}}', 'alias' : $(elem).text().trim() };
    }).get();

    data['categorias'] = titles;


    // encode to JSON format
    var products_json = JSON.stringify(data,null,'\t');
    //$('#printCode').html(products_json);
    //console.log(products_json);
    console.log(titles);

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
@php
      function is_local() {
        if($_SERVER['HTTP_HOST'] == 'localhost' ||
             substr($_SERVER['HTTP_HOST'],0,3) == '10.' ||
             substr($_SERVER['HTTP_HOST'],0,7) == '192.168') {
             return true;
            }
            return false;
           }

     if (is_local()) {
      $elurl =  asset('index.php/empresa/'.$empresas->id.'/ordencategorias');
     }
     else {
         $elurl =  asset('/empresa/'.$empresas->id.'/ordencategorias');
     }
@endphp

          $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{$elurl}}",
                  data: products_json,
                  contentType: "application/json; charset=utf-8",
                  success: function(data){
                      swal.fire('Mensaje', data.texto, data.type);
                      //console.log(data);
                  },
                  error: function(e){
                      console.log(e.message);
                  }
          });

  });


    $('.btnEditable').on('click', function(e){

      var clasificaId = $(e.target).attr('clasificaid');
      var objeto = $('#txClasifica'+clasificaId);
        var esEditable = objeto.attr('contenteditable');
      console.log( objeto.text() );

      if(esEditable){
        objeto.attr('contenteditable', false);
        //$('#btnEditable').html('Hacerlo Editable');
      }else{
        objeto.attr('contenteditable', true);
        objeto.focus();
        //$('#btnEditable').html('dejar der editar');
      }
    });

//crear elementos ordenables
      @php
        if (is_local()) {
         $elurljson =  asset('index.php/empresa/'.$empresas->id.'/ordensubcategoriasjson');
        }
        else {
            $elurljson =  asset('/empresa/'.$empresas->id.'/ordensubcategoriasjson');
        }
        @endphp
        function getData() {
            return $.getJSON('{{$elurljson}}');
          }

        function buildItem(item) {
          var _this2 = this;

          var html = "<li class=\"dd-item container\" data-id=\"".concat(item.id, "\">\n      <div class=\"dd-handle\">\n        <span class=\"drag-indicator\"></span>\n        <div>").concat(item.text, "</div>\n        <div class=\"dd-nodrag btn-group ml-auto\">\n          <button class=\"btn btn-sm btn-secondary\">Editar</button>\n         <!-- <button class=\"btn btn-sm btn-secondary\"><i class=\"far fa-trash-alt\"></i></button> -->\n        </div>\n      </div>");

          if (item.children) {
            html += '<ol class="dd-list">';
            $.each(item.children, function (index, sub) {
              html += _this2.buildItem(sub);
            });
            html += '</ol>';
          }

          html += '</li>';
          return html;
        }

        function Iniciar() {
          var _this = this;
          this.getData().done(function (data) {
            var items = '';
            console.log('orden cargado..');
            console.log(data);
            $.each(data, function (index, item) {
              items += _this.buildItem(item);
            });
            $('#nestable03').children().html(items);
          });
        }

        $('#cargarOrden').click(function() {
          console.log('Cargando el Orden....');
          Iniciar();

          var containers = null;
            containers = document.querySelectorAll(".container");
            for (var i = 0; i < containers.length; i++) {
              new Sortable(containers[i], sortableOptions2);
            }

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
                          @if($empresas->categorias->count() > 0)
                            @foreach($empresas->categorias->sortBy('pivot.orden') as $clasifica)
                            <li class="dd-item container" data-id="{{$clasifica->id}}">
                              <div class="dd-handle">
                                <span class="drag-indicator"></span>
                                <div orden="{{$clasifica->id}}" class="categoriaOrden" id="txClasifica{{$clasifica->id}}"> {{ $clasifica->pivot->alias ? $clasifica->pivot->alias : $clasifica->nombre}} </div>
                                  <div class="btn-group ml-auto">
                                      <button class="btn btn-sm btn-secondary btnEditable" clasificaid = "{{$clasifica->id}}">Editar</button> <button class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></button>
                                    </div>
                              </div>
                            </li>
                            @endforeach
                          @else
                          <!-- Se agregan las categorias faltantes -->
                          @foreach($categorias->whereNotIn('id', $empresas->categorias->pluck('id')) as $miclasifica)

                            <li class="dd-item container" data-id="{{$miclasifica->id}}">
                              <div class="dd-handle">
                                <span class="drag-indicator"></span>
                                <div orden="{{$miclasifica->id}}" class="categoriaOrden" id="txClasifica{{$miclasifica->id}}"> {{$miclasifica->nombre}} </div>
                                <div class="btn-group ml-auto">
                                    <button class="btn btn-sm btn-secondary btnEditable" clasificaid = "{{$miclasifica->id}}">Editar</button> <button class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></button>
                                  </div>
                              </div>
                            </li>
                          @endforeach
                        @endif

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
                    <div class="card-header border-bottom-0"> JSON Generation </div><!-- .nestable -->
                    <div id="nestable03" class="dd">
                    <ol class="dd-list"></ol>
                    </div><!-- /.nestable -->
                    <!-- .card-footer -->
                    <div class="card-footer">
                    <a id="cargarOrden" href="#" class="card-footer-item justify-content-start"><span><i class="fa fa-plus-circle mr-1"></i> Cargar el Orden de Categorias</span></a>
                    </div><!-- /.card-footer -->
                    </div><!-- /.card -->

                  </div><!-- /grid column -->
                </div>

@endcard

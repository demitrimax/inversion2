<div class="card card-fluid">
  <div class="card-header border-bottom-0"> Orden Subcategorias </div><!-- .nestable -->
  <div id="nestable02" class="dd" data-toggle="nestable" data-group="1" data-max-depth="5">
    <!-- .dd-list -->
    <ol class="dd-list">
      @foreach($empresas->categorias->sortBy('pivot.orden') as $clasifica)
      <li class="dd-item" data-id="{!!$clasifica->id!!}">
        <div class="dd-handle">

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

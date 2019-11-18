<div id="{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="{{$id}}" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              @isset($title)
              <div class="modal-header">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="{{$id}}">{{$title}}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              @endisset

              <div class="modal-body">
                  {{ $slot}}


              <div class="modal-footer">

                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                  @isset($closebutton)
                  <button type="submit" class="btn btn-primary waves-effect waves-light">{{$closetitle}}</button>
                  @endisset
              </div>
              {!! Form::close() !!}


          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
</div>

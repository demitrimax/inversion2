<!-- LARGE MODAL -->
<div id="{{$id}}" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content tx-size-sm">
      @isset($title)
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{$title}}</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endisset

      <div class="modal-body pd-20">
        {{$slot}}

      </div><!-- modal-body -->

      <div class="modal-footer">
        @isset($closebutton)
        <button type="submit" class="btn btn-info pd-x-20">{{$closebutton}}</button>
        @endisset
        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

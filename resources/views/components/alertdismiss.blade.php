<div class="alert alert-{{ isset($color) ? $color : 'info'}}" role="alert">
  <button class="close" aria-label="Close" type="button" data-dismiss="alert">
    <span aria-hidden="true">×</span>
  </button>
  <div class="d-flex align-items-center justify-content-start">
    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
    <span><strong>{{$strong}}</strong> {{ $slot}}</span>
  </div><!-- d-flex -->
</div>

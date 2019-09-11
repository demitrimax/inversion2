<div class="row">
  <div class="col">
    <div class="card bd-0">
      @isset($title)
        <div class="card-header card-header-default {!! isset($color) ? 'bg-'.$color : '' !!}">{{$title}}</div>
      @endisset
      <div class="card-body bd bd-t-0">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>

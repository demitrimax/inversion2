<div class="row">
  <div class="col">
    <div class="card bd-0">
      @isset($title)
        <div class="card-header">{{$title}}</div>
      @endisset
      <div class="card-body">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>

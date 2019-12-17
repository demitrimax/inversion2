    <div class="card rounded-0">
      @isset($title)
        <div class="card-header card-header-default {!! isset($color) ? 'bg-'.$color : '' !!} {!! isset($classid) ? $classid : ''!!}">{{$title}}</div>
      @endisset
      <div class="card-body bd bd-t-0">
        {{ $slot }}
      </div>
    </div>

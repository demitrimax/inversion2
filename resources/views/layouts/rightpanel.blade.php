<div class="sl-sideright">
  <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" role="tab" href="#tareas">Tareas ({{$vartareas->count()}})</a>
    </li>
    @can('ver-notificaciones')
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notificaciones (2)</a>
    </li>
    @endcan
  </ul><!-- sidebar-tabs -->

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="tareas" role="tabpanel">
      <div class="media-list">
        <!-- loop starts here -->
        @foreach($vartareas as $vtarea)
        <a href="{!! route('tareas.show', [$vtarea->id]) !!}" class="media-list-link">
          <div class="media">
            <img src="{{asset('starlight/img/img3.jpg')}}" class="wd-40 rounded-circle" alt="">
            <div class="media-body">
              <p class="mg-b-0 tx-medium tx-gray-800 tx-13">{{ $vtarea->nombre }}</p>
              <span class="d-block tx-11 tx-gray-500">{{$vtarea->created_at->diffForHumans() }}</span>
              <p class="tx-13 mg-t-10 mg-b-0">{!! strip_tags($vtarea->descripcion)  !!}</p>
            </div>
          </div><!-- media -->
        </a>
        <!-- loop ends here -->
    @endforeach


      </div><!-- media-list -->

      <div class="pd-15">
        <a href="{{url('profile')}}" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">Ver todas las tareas</a>
      </div>
    </div><!-- #messages -->

    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
      <div class="media-list">
        <!-- loop starts here -->
        <a href="" class="media-list-link read">
          <div class="media pd-x-20 pd-y-15">
            <img src="{{asset('starlight/img/img8.jpg')}}" class="wd-40 rounded-circle" alt="">
            <div class="media-body">
              <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
              <span class="tx-12">October 03, 2017 8:45am</span>
            </div>
          </div><!-- media -->
        </a>
        <!-- loop ends here -->

        <a href="" class="media-list-link read">
          <div class="media pd-x-20 pd-y-15">
            <img src="{{asset('starlight/img/img5.jpg')}}" class="wd-40 rounded-circle" alt="">
            <div class="media-body">
              <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
              <span class="tx-12">September 23, 2017 9:19pm</span>
            </div>
          </div><!-- media -->
        </a>
      </div><!-- media-list -->
    </div><!-- #notifications -->

  </div><!-- tab-content -->
</div><!-- sl-sideright -->

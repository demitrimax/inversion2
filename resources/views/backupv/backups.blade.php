
@extends('layouts.appv2')

@section('css')
<!-- Ladda Buttons (loading buttons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Backups de la base de datos'])
            @component('backupv.menu-nav')
                <li class="nav-item active mr-3">
                    <button href="{{ url('backup/createbackup') }}" class="btn btn-primary ladda-button" title="Crear nuevo backup" id="create-new-backup-button" data-style="zoom-in">
                        <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo backup
                    </button>
                </li>
            @endcomponent
                    @include('flash::message')
            <div class="py-4"></div>
            @include('backupv.backups-table')
            <div class="py-3"></div>
        @endcard
    </div>
@endsection

@section('scripts')

  <!-- PNotify -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.brighttheme.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.animate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.callbacks.js.map"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.nonblock.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.mobile.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.history.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.desktop.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.confirm.js"></script>


<!-- Ladda Buttons (loading buttons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/spin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js"></script>
<script>
jQuery(document).ready(function($) {
  // capture the Create new backup button
  $("#create-new-backup-button").click(function(e) {
      e.preventDefault();
      var create_backup_url = $(this).attr('href');
      // Create a new instance of ladda for the specified button
      var l = Ladda.create( document.querySelector( '#create-new-backup-button' ) );
      // Start loading
      l.start();
      // Will display a progress bar for 10% of the button width
      l.setProgress( 0.1 );
      setTimeout(function(){ l.setProgress( 0.3 ); }, 2000);
      // do the backup through ajax
      $.ajax({
              url: create_backup_url,
              type: 'GET',
              success: function(result) {
                  l.setProgress( 0.9 );
                  // Show an alert with the result
                  if (result.indexOf('failed') >= 0) {
                      new PNotify({
                          title: "{{ trans('backpack::backup.create_warning_title') }}",
                          text: "{{ trans('backpack::backup.create_warning_message') }}",
                          type: "warning"
                      });
                  }
                  else
                  {
                      new PNotify({
                          title: "{{ trans('backpack::backup.create_confirmation_title') }}",
                          text: "{{ trans('backpack::backup.create_confirmation_message') }}",
                          type: "success"
                      });
                  }
                  // Stop loading
                  l.setProgress( 1 );
                  l.stop();
                  // refresh the page to show the new file
                  setTimeout(function(){ location.reload(); }, 3000);
              },
              error: function(result) {
                  l.setProgress( 0.9 );
                  // Show an alert with the result
                  new PNotify({
                      title: "{{ trans('backpack::backup.create_error_title') }}",
                      text: "{{ trans('backpack::backup.create_error_message') }}",
                      type: "warning"
                  });
                  // Stop loading
                  l.stop();
              }
          });
  });
  // capture the delete button
  $("[data-button-type=delete]").click(function(e) {
      e.preventDefault();
      var delete_button = $(this);
      var delete_url = $(this).attr('href');
      if (confirm("{{ trans('backpack::backup.delete_confirm') }}") == true) {
          $.ajax({
              url: delete_url,
              type: 'DELETE',
              success: function(result) {
                  // Show an alert with the result
                  new PNotify({
                      title: "{{ trans('backpack::backup.delete_confirmation_title') }}",
                      text: "{{ trans('backpack::backup.delete_confirmation_message') }}",
                      type: "success"
                  });
                  // delete the row from the table
                  delete_button.parentsUntil('tr').parent().remove();
              },
              error: function(result) {
                  // Show an alert with the result
                  new PNotify({
                      title: "{{ trans('backpack::backup.delete_error_title') }}",
                      text: "{{ trans('backpack::backup.delete_error_message') }}",
                      type: "warning"
                  });
              }
          });
      } else {
          new PNotify({
              title: "{{ trans('backpack::backup.delete_cancel_title') }}",
              text: "{{ trans('backpack::backup.delete_cancel_message') }}",
              type: "info"
          });
      }
    });
});
</script>
@endsection

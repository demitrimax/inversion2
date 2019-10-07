@if (count($backups))
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Archivo</th>
                <th>Tamaño</th>
                <th>Fecha</th>
                <th>Edad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ $backup['file_size'] }}</td>
                    <td>
                        {{ date('d/M/Y, g:ia', strtotime($backup['last_modified'])) }}
                    </td>
                    <td>
                        {{ $backup['last_modified']->diffForHumans() }}
                    </td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ url('backup/download/'.$backup['file_name']) }}">
                            <i class="fas fa-download"></i> Download</a>
                        <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url('backup/delete/'.$backup['file_name']) }}">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h1 class="text-muted">No existen backups</h1>
    </div>
@endif

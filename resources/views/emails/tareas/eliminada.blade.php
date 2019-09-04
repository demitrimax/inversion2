@component('mail::message')
# Se ha Eliminado una Tarea

Por este medio le informamos que se acaba de eliminar una tarea que tenía asignada.

No es necesaria ninguna acción de su parte.

Estos son los detalles:
<ul>
    <li>Tarea: {{ $tareas->nombre }}</li>
    <li>Vencimiento: {{ $tareas->vencimiento->format('d-m-Y') }}</li>
    <li>Asignado por: {{ $tareas->asignadopor->name }}</li>
</ul>

Gracias por su atención,<br>
El equipo de {{ config('app.name') }}
@endcomponent

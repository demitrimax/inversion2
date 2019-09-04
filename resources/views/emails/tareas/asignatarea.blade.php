@component('mail::message')
# Tarea Asignada

Hola, el motivo de este correo es para informarle que se le ha asignado una nueva tarea.
<p>Estos son los detalles de la tarea:</p>

<ul>
    <li>Tarea: {{ $tareas->nombre }}</li>
    <li>Vencimiento: {{ $tareas->vencimiento->format('d-m-Y') }}</li>
    <li>Asignado por: {{ $tareas->asignadopor->name }}</li>
</ul>

@component('mail::button', ['url' => 'tareas/'.$tareas->id])
Detalles de la Tarea
@endcomponent

Gracias,<br>
El equipo de {{ config('app.name') }}
@endcomponent

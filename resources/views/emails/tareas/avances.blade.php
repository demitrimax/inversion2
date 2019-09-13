@component('mail::message')
# Registro de Avances de Tarea {{$tarea->avance_porc}}%

Por este medio, le informamos que se ha registrado avances en el desarrollo de la tarea encomendada.

{{$tarea->nombre}}

@component('mail::button', ['url' => url('tareas/'.$tarea->id)])
Detalles
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent

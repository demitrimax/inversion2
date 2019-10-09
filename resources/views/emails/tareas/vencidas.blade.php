@component('mail::message')
# Tarea Vencida: <b>{{$tareas->nombre}}</b>

Por este medio le informamos sobre una tárea que tiene asignada y que actualmente se encuentra en estatus de <b> {{$tareas->estatusdate['descripcion']}} </b>.

La tarea se le fue asignada por: <b>{{$tareas->asignadopor->name}}</b>

Sea tan amable de darle seguimiento a esta tarea o pedir a su jefe que extienda el plazo, de lo contrario este mensaje se le seguirá enviando.


Gracias,<br>
El Equipo de {{ config('app.name') }}
@endcomponent

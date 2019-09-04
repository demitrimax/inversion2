<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Tarea Asignada</title>
</head>
<body>
    <p>Hola, el motivo de este correo es para informarle que se le ha asignado una nueva tarea.</p>
    <p>Estos son los detalles de la tarea:</p>
    <ul>
        <li>Tarea: {{ $tareas->nombre }}</li>
        <li>Vencimiento: {{ $tareas->vencimiento->format('d-m-Y') }}</li>
        <li>Asignado por: {{ $tareas->user->name }}</li>
    </ul>
    <p>Podrá revisar los detalles de la tarea asignada en el siguiente vinculo:</p>
    <ul>
        <li><a href="{{url('tareas/'.$tareas->id)}}">Detalles</a></li>
    </ul>
</body>
</html>

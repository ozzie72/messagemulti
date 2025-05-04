<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activación de Correo Electrónico</title>
    <style>
        h1: {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Hola {{ $user->name }}</h1>
    <p>Para activar la cuenta haga click en el siguiente enlace: <strong>{{ $confirmationUrl }}</strong></p>
    <p>Si no ha creado una cuenta, puede ignorar este mensaje.</p>
    <p>Gracias.</p>
    <br>
    {{ config('app.name') }}
</body>
</html>

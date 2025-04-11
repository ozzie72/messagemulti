<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1: {
            color: red;
        }

    </style>
</head>
<body>
    <h1># Hola {{ $user->name }}</h1>

    {{ $confirmationUrl }}



    Si no creaste una cuenta, puedes ignorar este mensaje.

    Gracias,<br>
    {{ config('app.name') }}

    
</body>
</html>

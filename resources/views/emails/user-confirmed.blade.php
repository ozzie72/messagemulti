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
    <h1>Hola {{ $user->name }}</h1>
    <h3>Gracias!</h3>
    <p>Su cuenta ha sido activada satisfactoriamente. Puede iniciar sesión con las credenciales proporcionadas.</p>
    <br>
    <a href="http://127.0.0.1:8000"></a>
    <br>
    {{ config('app.name') }}
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Confirmación de registro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Bienvenido, {{ $name }}!</h1>
        <p>Gracias por registrarte en nuestro sitio web. Para confirmar tu correo electrónico, haz clic en el siguiente enlace:</p>
        <a href="{{ url('registrarse/confirm/'.$confirm_code.'/'.$email)}}">Confirmar correo electrónico</a>
    </body>
</html>

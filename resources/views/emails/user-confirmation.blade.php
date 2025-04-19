@component('mail::message')
# Hola {{ $user->name }},

Por favor haz clic en el siguiente enlace para confirmar tu cuenta:

@component('mail::button', ['url' => $confirmationUrl])
Confirmar Cuenta
@endcomponent

Si no creaste una cuenta, puedes ignorar este mensaje.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
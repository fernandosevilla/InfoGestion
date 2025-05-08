<x-mail::message>
# Restablecer contraseña

Hola {{ $notifiable->name }}

Has solicitado restablecer tu contraseña en **{{ config('app.name') }}**.
Haz clic en el botón de abajo:

<x-mail::button :url="$url">
Restablecer contraseña
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>

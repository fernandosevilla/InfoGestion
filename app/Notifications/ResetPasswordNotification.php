<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * El token de restablecimiento.
     *
     * @var string
     */
    public $token;

    /**
     * Crea una nueva instancia de la notificación.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // Construye la URL aquí:
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablece tu contraseña en '.config('app.name'))
            ->markdown('emails.password.reset', [
                'url'        => $url,
                'notifiable' => $notifiable,
            ]);
    }
}

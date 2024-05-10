<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $password;
    /**
     * Create a new notification instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Aquí puedes generar el enlace temporal o incluir la contraseña directamente en el correo
        $password = $this->password;

        return (new MailMessage)
                    ->subject('¡Bienvenido a nuestra aplicación!')
                    ->line('¡Hola ' . $notifiable->name . '!')
                    ->line('Tu cuenta ha sido creada exitosamente. A continuación, te proporcionamos tu contraseña:')
                    ->line('Contraseña: ' . $password)
                    ->line('Por razones de seguridad, te recomendamos cambiar tu contraseña después de iniciar sesión.')
                    ->action('Iniciar Sesión', url('/sign-in'))
                    ->line('¡Gracias por unirte a nosotros!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

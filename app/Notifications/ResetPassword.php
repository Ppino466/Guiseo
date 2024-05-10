<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\URL;

class ResetPassword extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

     public function toMail($notifiable)
     {
         // Genera una URL con firma temporal válida por 12 horas.
         $url = URL::temporarySignedRoute('reset-password', now()->addHours(12), ['id' => $this->token]);
     
         return (new MailMessage)
                     ->line('¡Hola!')
                     ->subject('Restablecer Contraseña')
                     ->line('Estás recibiendo este correo electrónico para poder restablecer la contraseña de tu cuenta.')
                     ->action('Restablecer Contraseña', $url)
                     ->line('Si no solicitaste esto, por favor ignora este correo electrónico.')
                     ->line('¡Gracias!');
     }
     

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
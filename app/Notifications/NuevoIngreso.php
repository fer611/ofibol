<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoIngreso extends Notification
{
    use Queueable;

    public $id_ingreso;
    public $usuario;
    public $total;
    /* Dueño de la empresa */
    public $owner_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($id_ingreso,$usuario,$total, $owner_id)
    {
        $this->id_ingreso = $id_ingreso;
        /* Quien realizo el ingreso */
        $this->usuario = $usuario;
        $this->total = $total;
        $this->owner_id = $owner_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notificaciones');
        return (new MailMessage)
            ->line('Se ha realizado un nuevo ingreso')
            ->line('Usuario: ' . $this->usuario)
            ->line('El total del ingreso es: ' . $this->total . ' Bs.')
            ->action('Ver Notificaciones', $url)
            ->line('Gracias por usar nuestra aplicación!');
    }

    /* Almacena las notificaciones en la base de datos */
    public function toDatabase($notifiable){
        return [
            'id_ingreso' => $this->id_ingreso,
            'usuario' => $this->usuario,
            'total' => $this->total,
            'owner_id' => $this->owner_id
        ];
    }
}

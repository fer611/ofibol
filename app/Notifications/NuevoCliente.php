<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoCliente extends Notification
{
    use Queueable;
    public $id_cliente;
    public $razon_social;
    public $nit;
    /* Dueño */
    public $owner_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($id_cliente, $razon_social, $nit, $owner_id)
    {
        $this->id_cliente = $id_cliente;
        $this->razon_social = $razon_social;
        $this->nit = $nit;
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
            ->line('Se ha registrado un nuevo cliente')
            ->line('Razón Social: ' . $this->razon_social)
            ->line('NIT: ' . $this->nit)
            ->action('Ver Notificaciones', $url)
            ->line('Gracias por usar nuestra aplicación!');
    }

    /* Almacena las notificaciones en la base de datos */
    public function toDatabase($notifiable)
    {
        return [
            'id_cliente' => $this->id_cliente,
            'razon_social' => $this->razon_social,
            'nit' => $this->nit,
            'owner_id' => $this->owner_id
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaVenta extends Notification
{
    use Queueable;
    public $id_venta;
    public $vendedor;
    public $total;
    /* Dueño de la empresa */
    public $owner_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($id_venta,$vendedor,$total, $owner_id)
    {
        $this->id_venta = $id_venta;
        $this->vendedor = $vendedor;
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
                    ->line('Se ha realizado una nueva venta')
                    ->line('Vendedor: '.$this->vendedor)
                    ->line('El total de la venta es: '.$this->total.' Bs.')
                    ->action('Ver Notificaciones', $url)
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    /* public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    } */

    /* Almacena las notificaciones en la base de datos */
    public function toDatabase($notifiable){
        return [
            'id_venta' => $this->id_venta,
            'vendedor' => $this->vendedor,
            'total' => $this->total,
            'owner_id' => $this->owner_id
        ];
    }
}

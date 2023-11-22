<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BajoStock extends Notification
{
    use Queueable;
    public $producto_id;
    public $producto_descripcion;
    public $producto_marca;
    public $producto_stock;
    /* La notificacion se la mandamos al dueño de la empresa */
    public $owner_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($producto_id, $producto_descripcion, $producto_marca, $producto_stock, $owner_id)
    {
        $this->producto_id = $producto_id;
        $this->producto_descripcion = $producto_descripcion;
        $this->producto_marca = $producto_marca;
        $this->producto_stock = $producto_stock;
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
            ->subject('Alerta de Bajo Stock: ' . $this->producto_descripcion)
            ->line('Hola,')
            ->line('Este es un aviso para informarte que el siguiente producto está con bajo stock:')
            ->line('Producto ID: ' . $this->producto_id)
            ->line('Descripción: ' . $this->producto_descripcion)
            ->line('Marca: ' . $this->producto_marca)
            ->line('Stock Actual: ' . $this->producto_stock)
            ->action('Ver Notificaciones', $url)
            ->line('Gracias por utilizar nuestra aplicación.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'producto_id' => $this->producto_id,
            'producto_descripcion' => $this->producto_descripcion,
            'producto_marca' => $this->producto_marca,
            'producto_stock' => $this->producto_stock,
            'owner_id' => $this->owner_id,
        ];
    }
}

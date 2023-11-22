<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        

        // Marcar como leídas las notificaciones
        /* auth()->user()->unreadNotifications->markAsRead(); */
        return view('notificaciones.index');
    }
    public function getNotificationsData()
    {
        // Supongamos que tienes una colección de notificaciones no leídas.
        $unreadNotifications = auth()->user()->unreadNotifications;

        // Now, we create the notification dropdown main content.
        $dropdownHtml = '';

        foreach ($unreadNotifications as $notification) {
            // Establecer el icono estáticamente, puedes cambiar 'fa-bell' al icono que desees.
           
            if ($notification->type == 'App\Notifications\NuevoCliente') {
                /* Notificacion de nuevo usuario */
                $icon = "<i class='mr-2 fas fa-fw fa-users'></i>";

                // Calculamos el tiempo transcurrido desde que se creó la notificación.
                $time = "<span class='float-right text-muted text-sm'>
                   {$notification->created_at->diffForHumans()}
                 </span>";

                $dropdownHtml .= "<a href='/usuarios' class='dropdown-item'>
                            {$icon} Nuevo usuario {$time}
                          </a>";
            }elseif ($notification->type == 'App\Notifications\NuevaVenta') {
                /* Notificacion de nueva venta */
                $icon = "<i class='mr-2 fas fa-fw fa-shopping-cart'></i>";

                // Calculamos el tiempo transcurrido desde que se creó la notificación.
                $time = "<span class='float-right text-muted text-sm'>
                   {$notification->created_at->diffForHumans()}
                 </span>";

                $dropdownHtml .= "<a href='/ventas' class='dropdown-item'>
                            {$icon} Nueva venta {$time}
                          </a>";
            }
            /* Aca demas notificaciones nuevas */
        }

        // Return the new notification data.
        return [
            'label'       => $unreadNotifications->count(),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }
}

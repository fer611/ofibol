<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarNotificaciones extends Component
{
    public function render()
    {
        /* Obteniendo las notificaciones */
        $notificaciones = auth()->user()->unreadNotifications;
        return view('livewire.mostrar-notificaciones', [
            'notificaciones' => $notificaciones
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
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

    public function marcarTodasLeidas()
    {
        /* Marcas las notificaciones leídas */
        auth()->user()->unreadNotifications->markAsRead();

        /* Redirigir a la misma página después de marcar como leídas */
        return redirect()->to(route('notificaciones.index'));
    }
}

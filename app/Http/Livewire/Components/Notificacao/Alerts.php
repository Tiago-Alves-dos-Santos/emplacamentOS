<?php

namespace App\Http\Livewire\Components\Notificacao;

use Livewire\Component;
use App\Models\Notification;

class Alerts extends Component
{
    public function render()
    {
        return view('livewire.components.notificacao.alerts', [
            'counter' => Notification::where('lida', 'N')->count(),
            'notificacoes' => Notification::where('lida', 'N')->limit(5)->get()
        ]);
    }
}

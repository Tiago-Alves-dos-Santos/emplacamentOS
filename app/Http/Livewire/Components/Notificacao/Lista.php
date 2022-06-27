<?php

namespace App\Http\Livewire\Components\Notificacao;

use Livewire\Component;
use App\Models\Notification;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.components.notificacao.lista', [
            'notificacoes' => Notification::where('lida', 'N')->paginate(30)
        ]);
    }
}

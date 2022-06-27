<?php

namespace App\Http\Livewire\Components\Notificacao;

use Livewire\Component;
use App\Models\Notification;

class Lista extends Component
{
    protected $listeners = [
        'notificacao.lista.reload' => '$refresh',
    ];

    public function marcarLida($notificacao_id)
    {
        Notification::where('id', $notificacao_id)->update([
            'lida' => 'S'
        ]);
        $this->emit('notificacao.lista.reload');
        $this->emit('notificacao.alerts.reload');
    }

    public function render()
    {
        return view('livewire.components.notificacao.lista', [
            'notificacoes' => Notification::where('lida', 'N')->paginate(30)
        ]);
    }
}

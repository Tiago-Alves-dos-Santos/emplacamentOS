<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'servico-table-reload' => '$refresh',
    ];

    public function setServico($id)
    {
        $this->emit('servico.form-update.setServico', $id);

    }

    public function render()
    {
        return view('livewire.components.servico.table',[
            'servicos' => Servico::paginate(10)
        ]);
    }
}

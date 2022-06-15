<?php

namespace App\Http\Livewire\Components\Taxa;

use App\Models\Taxa;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'taxa-table-reload' => '$refresh',
    ];

    public function setTaxa($id)
    {
        //$this->emit('servico.form-update.setServico', $id);

    }
    public function render()
    {
        return view('livewire.components.taxa.table', [
            'taxas' => Taxa::get()
        ]);
    }
}

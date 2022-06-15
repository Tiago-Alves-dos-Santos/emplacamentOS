<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Taxa;
use Livewire\Component;

class TableTaxaVincular extends Component
{
    public function render()
    {
        return view('livewire.components.servico.table-taxa-vincular', [
            'taxas' => Taxa::get()
        ]);
    }
}

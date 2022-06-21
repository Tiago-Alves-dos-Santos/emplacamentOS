<?php

namespace App\Http\Livewire\Components\Veiculo;

use Livewire\Component;
use App\Models\Veiculos;

class Table extends Component
{
    protected $listeners = [
        'veiculos-reload' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.components.veiculo.table', [
            'veiculos' => Veiculos::paginate(30)
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components\Veiculo;

use Livewire\Component;
use App\Models\Veiculos;

class Table extends Component
{
    public $cliente_id = 0;
    protected $listeners = [
        'veiculos-reload' => '$refresh',
    ];

    public function mount($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }
    public function render()
    {
        return view('livewire.components.veiculo.table', [
            'veiculos' => Veiculos::where('cliente_id', $this->cliente_id)->paginate(30)
        ]);
    }
}

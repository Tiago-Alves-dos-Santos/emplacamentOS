<?php

namespace App\Http\Livewire\Components\Cliente;

use App\Models\Cliente;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.components.cliente.table', [
            'clientes' => Cliente::paginate(10)
        ]);
    }
}

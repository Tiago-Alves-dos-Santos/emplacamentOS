<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\OS;
use Livewire\Component;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.components.os.lista', [
            // 'os' => OS::JOIN('clientes', 'clientes.id', '=', 'os.cliente_id')
            // ->JOIN('veiculos','veiculos.id','=','os.veiculo_id')
            // ->select('os.id','os.descricao','os.created_at','clientes.nome','veiculos.modelo','veiculos.placa')
            // ->paginate(30)
            'os' => OS::JOIN('clientes', 'clientes.id', '=', 'os.cliente_id')
            ->JOIN('veiculos','veiculos.id','=','os.veiculo_id')
            ->select('os.id','os.descricao','os.created_at','clientes.nome','veiculos.modelo','veiculos.placa')
            ->paginate(30)
        ]);
    }
}

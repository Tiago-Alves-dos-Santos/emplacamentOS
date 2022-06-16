<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use Livewire\Component;

class SearchCliente extends Component
{
    public $search = "";
    public $cliente_id = 0;
    //deve ser um metodo publico e ser passado uma lista de serviço e aq ser feito cadastro da os
    public function cadastrarOs($servicos_ids)
    {
        # code...
    }

    public function render()
    {
        return view('livewire.components.os.search-cliente',[
            'clientes' => ($this->search == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search}%")->get()
        ]);
    }

}

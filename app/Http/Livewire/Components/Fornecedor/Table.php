<?php

namespace App\Http\Livewire\Components\Fornecedor;

use Livewire\Component;
use App\Models\Fornecedor;

class Table extends Component
{
    protected $listeners = [
        'fornecedor-table-reload' => '$refresh',
    ];

    public function setID($id)
    {
        $this->emit('fornecedor-formUpdt-setID', $id);
        $this->emit('openModal', 'editarFornecedor');
    }

    public function excluir($id)
    {
        Fornecedor::where('id', $id)->delete();
        $this->emit('fornecedor-table-reload');
    }

    public function render()
    {
        return view('livewire.components.fornecedor.table',[
            'fornecedores' => Fornecedor::paginate(10)
        ]);
    }
}

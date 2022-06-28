<?php

namespace App\Http\Livewire\Components\Fornecedor;

use Livewire\Component;
use App\Models\Fornecedor;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
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
            'fornecedores' => Fornecedor::where('nome','like',"%{$this->search}%")
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public function render()
    {
        return view('livewire.components.cliente.table', [
            'clientes' => Cliente::where('nome','like',"%{$this->search}%")
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

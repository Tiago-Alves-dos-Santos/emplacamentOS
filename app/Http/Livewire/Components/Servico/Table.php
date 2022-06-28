<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    protected $listeners = [
        'servico-table-reload' => '$refresh',
    ];

    public function setServico($id)
    {
        $this->emit('servico.form-update.setServico', $id);

    }

    public function render()
    {
        return view('livewire.components.servico.table',[
            'servicos' => Servico::where('nome','like',"%{$this->search}%")
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

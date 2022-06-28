<?php

namespace App\Http\Livewire\Components\Taxa;

use App\Models\Taxa;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    protected $listeners = [
        'taxa-table-reload' => '$refresh',
    ];

    public function setTaxa($id)
    {
        $this->emit('taxa.form-update.setTaxa', $id);

    }
    public function render()
    {
        return view('livewire.components.taxa.table', [
            'taxas' => Taxa::where('nome','like',"%{$this->search}%")
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

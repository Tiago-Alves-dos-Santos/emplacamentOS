<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;
use App\Models\ServicoTaxa;

class TableTaxaServico extends Component
{
    public $servico_id = 0;
    public function mount($servico_id)
    {
        $this->servico_id = $servico_id;
    }
    public function render()
    {
        return view('livewire.components.servico.table-taxa-servico', [
            'taxas_servico' => Servico::find($this->servico_id)
            ->taxas()
            ->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Pages\Servico;

use App\Models\Servico;
use Livewire\Component;

class TaxasVincular extends Component
{
    public $servico_id = 0;
    public function mount($servico_id)
    {
        $this->servico_id = $servico_id;
    }
    public function render()
    {
        return view('livewire.pages.servico.taxas-vincular',[
            'servico' => Servico::find($this->servico_id)
        ])
        ->extends('layouts.admin', ['page_active' => 'servico.dashboard'])
        ->section('conteudo');
    }
}

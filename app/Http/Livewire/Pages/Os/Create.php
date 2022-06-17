<?php

namespace App\Http\Livewire\Pages\Os;

use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Create extends Component
{
    public $data = null;
    public $servicos_add = [];
    public $valor = "";
    protected $listeners = [
        'os.creloadate.reload' => '$refresh',
        'adicionar'
    ];

    public function mount()
    {

        // dd($this->data);
    }

    public function adicionar($servico_id, $valor)
    {
        $this->servicos_add[] =  [
            'servico_id' => $servico_id,
            'valor' => $valor
        ];
        $this->valor = "";
        $this->emit('os.creloadate.reload');
    }

    public function remover($servico_id)
    {
        # code...
    }

    public function render()
    {
        $servico_ids = [];
        foreach($this->servicos_add as $value){
            $value = (object) $value;
            $servico_ids[] = $value->servico_id;
        }
        return view('livewire.pages.os.create',[
            'servicos_existentes' => Servico::whereNotIn('id', $servico_ids)
            ->paginate(10),
            'servicos_lista' => $this->servicos_add
        ])
        ->extends('layouts.admin', ['page_active' => 'os.create'])
        ->section('conteudo');
    }
}

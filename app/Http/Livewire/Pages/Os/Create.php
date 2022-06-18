<?php

namespace App\Http\Livewire\Pages\Os;

use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;

class Create extends Component
{
    public $cliente_id = 0;
    public $search_cliente = "";
    public $search = "";
    protected $listeners = [
        'os.reload.reload' => '$refresh',
    ];

    public function mount()
    {

        // dd($this->data);
    }


    public function render()
    {
        return view('livewire.pages.os.create',[
            'servicos' => ($this->search == "")?[]:
            Servico::where('nome','like', "%{$this->search}%")
            ->paginate(10),
            'clientes' => ($this->search_cliente == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search_cliente}%")->get()
        ])
        ->extends('layouts.admin', ['page_active' => 'os.create'])
        ->section('conteudo');
    }
}

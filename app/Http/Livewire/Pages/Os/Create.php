<?php

namespace App\Http\Livewire\Pages\Os;

use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;

class Create extends Component
{
    protected $listeners = [
        //'os.reload.reload' => '$refresh',
    ];

    public function mount()
    {

        // dd($this->data);
    }


    public function render()
    {
        return view('livewire.pages.os.create')
        ->extends('layouts.admin', ['page_active' => 'os.create'])
        ->section('conteudo');
    }
}

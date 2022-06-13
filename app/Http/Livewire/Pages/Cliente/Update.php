<?php

namespace App\Http\Livewire\Pages\Cliente;

use Livewire\Component;

class Update extends Component
{
    public $cliente_id = 0;
    public function mount($id)
    {
        $this->client_id = $id;
    }
    public function render()
    {
        return view('livewire.pages.cliente.update')
        ->extends('layouts.admin', ['page_active' => 'cliente.dashboard'])
        ->section('conteudo');
    }
}

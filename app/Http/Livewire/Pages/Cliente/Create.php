<?php

namespace App\Http\Livewire\Pages\Cliente;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.cliente.create')
        ->extends('layouts.admin', ['page_active' => 'cliente.dashboard'])
        ->section('conteudo');
    }
}

<?php

namespace App\Http\Livewire\Pages\Cliente;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.cliente.dashboard')
        ->extends('layouts.admin', ['page_active' => 'cliente.dashboard'])
        ->section('conteudo');
    }
}

<?php

namespace App\Http\Livewire\Pages\Servico;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.servico.dashboard')
        ->extends('layouts.admin', ['page_active' => 'servico.dashboard'])
        ->section('conteudo');
    }
}

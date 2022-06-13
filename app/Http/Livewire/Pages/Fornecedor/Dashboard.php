<?php

namespace App\Http\Livewire\Pages\Fornecedor;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.fornecedor.dashboard')
        ->extends('layouts.admin', ['page_active' => 'fornecedor.dashboard'])
        ->section('conteudo');
    }
}

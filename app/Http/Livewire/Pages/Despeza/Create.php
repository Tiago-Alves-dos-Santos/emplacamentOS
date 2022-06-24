<?php

namespace App\Http\Livewire\Pages\Despeza;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.despeza.create')
        ->extends('layouts.admin', ['page_active' => 'despeza.create'])
        ->section('conteudo');
    }
}

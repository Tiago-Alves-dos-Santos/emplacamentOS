<?php

namespace App\Http\Livewire\Pages\Despeza;

use Livewire\Component;

class FiltroMensal extends Component
{
    public function render()
    {
        return view('livewire.pages.despeza.filtro-mensal')
        ->extends('layouts.admin', ['page_active' => 'despeza.filter-mensal'])
        ->section('conteudo');
    }
}

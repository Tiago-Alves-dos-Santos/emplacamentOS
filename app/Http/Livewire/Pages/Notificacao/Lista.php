<?php

namespace App\Http\Livewire\Pages\Notificacao;

use Livewire\Component;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.pages.notificacao.lista')
        ->extends('layouts.admin', ['page_active' => ''])
        ->section('conteudo');
    }
}

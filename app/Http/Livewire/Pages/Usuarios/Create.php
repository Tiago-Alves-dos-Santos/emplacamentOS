<?php

namespace App\Http\Livewire\Pages\Usuarios;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.usuarios.create')
        ->extends('layouts.admin', ['page_active' => 'user.dashboard'])
        ->section('conteudo');
    }
}

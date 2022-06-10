<?php

namespace App\Http\Livewire\Pages\Usuarios;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.usuarios.dashboard')
        ->extends('layouts.admin', ['page_active' => 'user.dashboard'])
        ->section('conteudo');
    }
}

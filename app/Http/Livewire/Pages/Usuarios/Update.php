<?php

namespace App\Http\Livewire\Pages\Usuarios;

use Livewire\Component;

class Update extends Component
{
    public $user_id = 0;
    public function mount($id)
    {
       $this->user_id = $id;
    }
    public function render()
    {
        return view('livewire.pages.usuarios.update')
        ->extends('layouts.admin', ['page_active' => 'user.dashboard'])
        ->section('conteudo');
    }
}

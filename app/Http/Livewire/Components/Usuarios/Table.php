<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.components.usuarios.table',[
            'users' => User::paginate(10)
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'users-reload' => '$refresh',
    ];
    public function updateStatus($id)
    {
        $user = User::find($id);
        $user->active = ($user->active == 'Y')?'N':'Y';
        $user->save();
        $this->emit('users-reload');
    }
    public function render()
    {
        return view('livewire.components.usuarios.table',[
            'users' => User::paginate(10)
        ]);
    }
}

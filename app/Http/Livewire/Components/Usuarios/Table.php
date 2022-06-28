<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    protected $listeners = [
        'users-reload' => '$refresh',
    ];

    // public function paginationView()
    // {
    //     return 'vendor.pagination.custom';
    // }

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
            'users' => User::where('name','like',"%{$this->search}%")
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

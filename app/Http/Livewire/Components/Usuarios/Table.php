<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;
use App\Http\Classes\Authentication;

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
        $condition_type = "true";
        if(Authentication::user()->type != 'admin'){
           $condition_type =  "type =  'common'";
        }
        return view('livewire.components.usuarios.table',[
            'users' => User::where('id', '!=', Authentication::user()->id)
            ->where('name','like',"%{$this->search}%")
            ->whereRaw($condition_type)
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

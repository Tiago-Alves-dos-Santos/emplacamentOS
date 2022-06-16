<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use Livewire\Component;

class FormCreate extends Component
{
    public $nome = "";
    public $select = 1;
    protected $listeners = [
       // 'teste-rl' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.components.os.form-create', [
            'clientes' => Cliente::get()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use Livewire\Component;

class FormCreate extends Component
{
    public $nome = "";
    public $select = "";
    protected $listeners = [
       // 'teste-rl' => '$refresh',
    ];

    public function enviar()
    {

    }
    public function render()
    {
        return view('livewire.components.os.form-create', [
            'clientes' => Cliente::get()
        ]);
    }
}

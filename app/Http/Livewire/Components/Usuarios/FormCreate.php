<?php

namespace App\Http\Livewire\Components\Usuarios;

use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $nome = "";
    public $email = "";
    public $senha = "";
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';
    protected $listeners = [
        'cliente-reload' => '$refresh',
    ];
    protected $rules = [
        'nome' => 'required|min:5',
        'email' => 'required|email',
        'senha' => 'required|min5'
    ];
    public function createUser()
    {
       $this->validate();
    }
    public function render()
    {
        return view('livewire.components.usuarios.form-create');
    }
}

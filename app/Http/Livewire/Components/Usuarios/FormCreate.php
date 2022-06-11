<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $nome = "";
    public $email = "";
    public $senha = "";
    public $type = "";
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
        'senha' => 'required|min:5'
    ];
    public function createUser()
    {
       $this->validate();
       try {
            if(!User::verificarEmail($this->email)){
                User::create([
                    'name' => mb_strtoupper($this->nome),
                    'email' => $this->email,
                    'password' => base64_encode($this->senha),
                    'type' => $this->type
                ]);
                $this->msg_toast['title'] = 'Sucesso!';
                $this->msg_toast['information'] = 'Cadastro realizado com sucesso!';
                $this->msg_toast['type'] = $this->toast_type['success'];
                $this->emit('showToast', $this->msg_toast);
                $this->resetExcept(['limpa']);
            }else{
                $this->addError('email', 'Subistitua o email.');
                $this->msg_toast['title'] = 'Atenção!';
                $this->msg_toast['information'] = 'Cadastro negado! <br> Email já em uso por outro usuário!';
                $this->msg_toast['type'] = $this->toast_type['warning'];
                $this->emit('showToast', $this->msg_toast);
            }

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }
    public function render()
    {
        return view('livewire.components.usuarios.form-create');
    }
}

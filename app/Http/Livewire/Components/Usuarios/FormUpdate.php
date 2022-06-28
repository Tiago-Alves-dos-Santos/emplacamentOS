<?php

namespace App\Http\Livewire\Components\Usuarios;

use App\Models\User;
use Livewire\Component;
use App\Http\Classes\Configuracao;
use Illuminate\Support\Facades\Hash;

new Configuracao();
class FormUpdate extends Component
{
    public $user_id = 0;
    public $nome = "";
    public $email = "";
    public $senha = null;
    public $old_password = "";
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
        //'cliente-reload' => '$refresh',
    ];
    protected $rules = [
        'nome' => 'required|min:5',
        'email' => 'required|email',
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($this->user_id);
        $this->nome = $user->name;
        $this->email = $user->email;
        $this->old_password = $user->password;
        $this->type = $user->type;
    }

    public function updateUser()
    {
        $this->validate();
       try {
            if(!User::verificarEmail($this->email, 'update', $this->user_id)){
                User::where('id', $this->user_id)->update([
                    'name' => mb_strtoupper($this->nome),
                    'email' => $this->email,
                    'password' => (empty($this->senha)?$this->old_password:Hash::make($this->senha)) ,
                    'type' => $this->type
                ]);
                $this->msg_toast['title'] = 'Sucesso!';
                $this->msg_toast['information'] = 'Atualização realizado com sucesso!';
                $this->msg_toast['type'] = $this->toast_type['success'];
                $this->emit('showToast', $this->msg_toast);
            }else{
                $this->addError('email', 'Subistitua o email.');
                $this->msg_toast['title'] = 'Atenção!';
                $this->msg_toast['information'] = 'Atualização negada! <br> Email já em uso por outro usuário!';
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
        return view('livewire.components.usuarios.form-update');
    }
}

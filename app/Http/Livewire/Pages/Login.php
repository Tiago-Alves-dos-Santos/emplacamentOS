<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email = "";
    public $senha = "";
    public $lembrar_de_min = false;
    public $alert_type = ['danger' => 0,'success'=> 1,'warning' => 2,'info' => 3,'purple' => 4,'dark' => 5];
    public $alert = [
        "title" => '',
        "information" => '',
        "type" => 1,
    ];
    public function login()
    {
        $existe = User::where('email', $this->email)->exists();
        if($existe){
            $user = User::where('email', $this->email)->first();
            if(Hash::check($this->senha, $user->password)){
                session([
                    'login' => true,
                    'user' => $user
                ]);
                //redirecionar
            }else{//senha inválida
                session([
                    'login' => false,
                ]);
            }
        }else{ //email não existente
            session([
                'login' => false,
            ]);
            $this->alert['title'] = "Atenção";
            $this->alert['information'] = "Usuário inexistente na base de dados!";
            $this->alert['type'] = $this->alert_type['warning'];
            $this->emit('showAlert', $this->alert);
        }
    }
    public function render()
    {
        return view('livewire.pages.login')
        ->extends('layouts.login', ['title' => 'login'])
        ->section('form');
    }
}

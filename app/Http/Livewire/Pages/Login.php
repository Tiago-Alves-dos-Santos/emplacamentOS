<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class Login extends Component
{
    public $email = "";
    public $senha = "";
    public $lembrar_de_min = null;
    public $alert_type = ['danger' => 0,'success'=> 1,'warning' => 2,'info' => 3,'purple' => 4,'dark' => 5];
    public $alert = [
        "title" => '',
        "information" => '',
        "type" => 1,
    ];

    public function mount()
    {
        if(Cookie::has('lembrar_de_mim')){
            $this->lembrar_de_min =  Cookie::get('lembrar_de_mim');
            $this->email =  Cookie::get('user_name');
            $this->senha =  Cookie::get('user_pass');
        }

    }

    public function login()
    {
        $existe = User::where('email', $this->email)->exists();
        if($existe){
            $user = User::where('email', $this->email)->first();
            if(Hash::check($this->senha, $user->password)){
                if($this->lembrar_de_min){
                    Cookie::queue(Cookie::make("lembrar_de_mim", true, time()+3600*24*30*12*1));
                    Cookie::queue(Cookie::make("user_name", $this->email, time()+3600*24*30*12*1));
                    Cookie::queue(Cookie::make("user_pass", $this->senha, time()+3600*24*30*12*1));
                }else{//apaga o cookie ou pelo menos seu valor
                    Cookie::queue(Cookie::forget('lembrar_de_mim'));
                    Cookie::queue(Cookie::forget('user_name'));
                    Cookie::queue(Cookie::forget('user_pass'));

                }
                session([
                    'login' => true,
                    'user' => $user
                ]);
                //redirecionar
                redirect()->route('home');
            }else{//senha inválida
                session([
                    'login' => false,
                ]);
                $this->alert['title'] = "Atenção";
                $this->alert['information'] = "Senha inválida!";
                $this->alert['type'] = $this->alert_type['warning'];
                $this->emit('showAlert', $this->alert);
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

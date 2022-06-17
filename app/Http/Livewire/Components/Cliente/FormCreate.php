<?php

namespace App\Http\Livewire\Components\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $nome = "";
    public $data_nasc = "";
    public $rua = "";
    public $numero = "";
    public $telefone = "";
    public $bairro = "";
    public $complemento = "";
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
        'telefone' => 'required|min:15|max:15',
    ];

    public function createCliente()
    {
       $this->validate();
       try {
            Cliente::create([
                'nome' => mb_strtoupper($this->nome),
                'data_nasc' => $this->data_nasc,
                'rua' => $this->rua,
                'numero' => $this->numero,
                'telefone' => $this->telefone,
                'bairro' => $this->bairro,
                'complemento' => $this->complemento
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Cadastro realizado com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);
            $this->resetExcept(['limpa']);

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }

    public function render()
    {
        return view('livewire.components.cliente.form-create');
    }
}

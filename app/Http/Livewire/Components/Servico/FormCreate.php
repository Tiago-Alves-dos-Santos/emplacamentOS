<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $nome = "";
    public $valor_type = null;
    public $valor = "";
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

    public function cadastrar()
    {
        try {
            Servico::create([
                'nome' => mb_strtoupper($this->nome),
                'valor_type' => $this->valor_type,
                'valor' => (empty($this->valor)?0:Configuracao::convertToMoney($this->valor))
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Cadastro realizado com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);
            $this->resetExcept(['limpa']);
            $this->emit('servico-table-reload');
            $this->emit('closeModal', 'cadastrarServico');

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }
    public function render()
    {
        return view('livewire.components.servico.form-create');
    }
}

<?php

namespace App\Http\Livewire\Components\Despeza;

use Livewire\Component;
use App\Models\Despezas;
use App\Models\Fornecedor;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $fornecedor_id = null;
    public $nome = null;
    public $valor = null;
    public $mes_referente = null;

    public $search_fornecedor = null;

    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';

    public function cadastrar()
    {
        try {
            $mes_referente = $this->mes_referente."-01";
            Despezas::create([
                'nome' => mb_strtoupper($this->nome),
                'valor' => Configuracao::convertToMoney($this->valor),
                'mes_referente' => $mes_referente,
                'fornecedor_id' => ($this->fornecedor_id ?? null)
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Despeza adicionada com sucesso!';
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
        return view('livewire.components.despeza.form-create',[
            'fornecedores' => Fornecedor::where('nome','like', "%{$this->search_fornecedor}%")->get()
        ]);
    }
}

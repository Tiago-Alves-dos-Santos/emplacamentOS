<?php

namespace App\Http\Livewire\Components\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormUpdate extends Component
{
    public $cliente_id = 0;
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
        'senha' => 'required|min:5'
    ];
    public function mount($id)
    {
        $this->cliente_id = $id;
        $cliente = Cliente::find($id);
        $this->nome = $cliente->nome;
        $this->data_nasc = $cliente->data_nasc;
        $this->telefone = $cliente->telefone;
        $this->rua = $cliente->rua;
        $this->numero = $cliente->numero;
        $this->bairro = $cliente->bairro;
        $this->complemento = $cliente->complemento;
    }

    public function updateCliente()
    {
        try {
            Cliente::where('id', $this->cliente_id)->update([
                'nome' => mb_strtoupper($this->nome),
                'data_nasc' => $this->data_nasc,
                'rua' => $this->rua,
                'numero' => $this->numero,
                'telefone' => $this->telefone,
                'bairro' => $this->bairro,
                'complemento' => $this->complemento
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Atualização realizada com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }

    public function render()
    {
        return view('livewire.components.cliente.form-update');
    }
}

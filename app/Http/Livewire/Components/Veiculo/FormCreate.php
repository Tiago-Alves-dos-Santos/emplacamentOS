<?php

namespace App\Http\Livewire\Components\Veiculo;

use Livewire\Component;
use App\Models\Veiculos;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    public $cliente_id;

    public $placa = "";
    public $marca = "";
    public $modelo = "";
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';
    protected $listeners = [
        //'veiculos-reload' => '$refresh',
    ];

    public function mount($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function cadastrar()
    {
        try {
            Veiculos::create([
                'cliente_id' => $this->cliente_id,
                'placa' => mb_strtoupper($this->placa),
                'marca' => mb_strtoupper($this->marca),
                'modelo' => mb_strtoupper($this->modelo)
            ]);
            $this->emit('veiculos-reload');
            $this->emit('closeModal','cadastrarVeiculo');
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
        return view('livewire.components.veiculo.form-create');
    }
}

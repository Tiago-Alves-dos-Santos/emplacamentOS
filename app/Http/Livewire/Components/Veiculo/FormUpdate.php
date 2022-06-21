<?php

namespace App\Http\Livewire\Components\Veiculo;

use Livewire\Component;
use App\Models\Veiculos;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormUpdate extends Component
{
    public $veiculo_id = 0;

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
        'veiculo-update-reload' => '$refresh',
        'show-modal-updateVeiculo' => 'loadVeiculo'
    ];
    public function mount()
    {

    }

    public function loadVeiculo($veiculo_id)
    {
        $this->veiculo_id = $veiculo_id;
        $veiculo = Veiculos::find($this->veiculo_id);
        $this->placa = $veiculo->placa;
        $this->modelo = $veiculo->modelo;
        $this->marca = $veiculo->marca;
        $this->emit('openModal', 'atualizarVeiculo');
    }

    public function atualizar()
    {
        try {
            Veiculos::where('id', $this->veiculo_id)->update([
                'placa' => mb_strtoupper($this->placa),
                'marca' => mb_strtoupper($this->marca),
                'modelo' => mb_strtoupper($this->modelo)
            ]);
            $this->emit('veiculo-update-reload');
            $this->emit('veiculos-reload');
            $this->emit('closeModal',"atualizarVeiculo");
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Atualização realizada com sucesso!';
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
        return view('livewire.components.veiculo.form-update');
    }
}

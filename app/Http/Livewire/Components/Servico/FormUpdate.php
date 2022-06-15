<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormUpdate extends Component
{
    public $servico_id = 0;
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
        'servico.form-update.setServico' => 'setServico'
    ];

    public function mount()
    {

    }

    public function atualizar()
    {
        try {
            Servico::where('id', $this->servico_id)->update([
                'nome' => mb_strtoupper($this->nome),
                'valor_type' => $this->valor_type,
                'valor' => (empty($this->valor)?0:Configuracao::convertToMoney($this->valor))
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Atualização do serviço realizada com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);
            $this->resetExcept(['limpa']);
            $this->emit('servico-table-reload');
            $this->emit('closeModal', 'atualizarServico');
        } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
        }
    }

    public function setServico($id)
    {
        $this->servico_id = $id;
        $servico = Servico::find($this->servico_id);
        $this->nome = $servico->nome;
        $this->valor_type = $servico->valor_type;
        $this->valor = Configuracao::getDbMoney($servico->valor);
        $this->emit('openModal','atualizarServico');
    }

    public function render()
    {
        return view('livewire.components.servico.form-update');
    }
}

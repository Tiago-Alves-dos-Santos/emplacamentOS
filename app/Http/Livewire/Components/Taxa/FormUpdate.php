<?php

namespace App\Http\Livewire\Components\Taxa;

use App\Models\Taxa;
use Livewire\Component;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormUpdate extends Component
{
    public $taxa_id = 0;
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
        'taxa.form-update.setTaxa' => 'setTaxa'
    ];

    public function mount()
    {

    }

    public function atualizar()
    {
        try {
            Taxa::where('id', $this->taxa_id)->update([
                'nome' => mb_strtoupper($this->nome),
                'valor_type' => $this->valor_type,
                'valor' => (empty($this->valor)?0:Configuracao::convertToMoney($this->valor))
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Atualização da taxa realizada com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);
            $this->resetExcept(['limpa']);
            $this->emit('taxa-table-reload');
            $this->emit('closeModal', 'atualizarTaxa');
        } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
        }
    }

    public function setTaxa($id)
    {
        $this->taxa_id = $id;
        $taxa = Taxa::find($this->taxa_id);
        $this->nome = $taxa->nome;
        $this->valor_type = $taxa->valor_type;
        $this->valor = Configuracao::getDbMoney($taxa->valor);
        $this->emit('openModal','atualizarTaxa');
    }
    public function render()
    {
        return view('livewire.components.taxa.form-update');
    }
}

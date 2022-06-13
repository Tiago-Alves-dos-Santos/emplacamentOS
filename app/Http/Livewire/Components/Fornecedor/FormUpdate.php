<?php

namespace App\Http\Livewire\Components\Fornecedor;

use Livewire\Component;
use App\Models\Fornecedor;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormUpdate extends Component
{
    public $fornecedor_id;
    public $nome = "";
    public $type = "";
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
        'fornecedor-formUpdt-setID' => 'setID',
    ];

    public function setID($id)
    {
        $this->fornecedor_id = $id;
        $this->nome = Fornecedor::find($id)->nome;
    }
    public function mount($fornecedor_id = 0)
    {
        if(!empty($fornecedor_id)){
            $this->fornecedor_id = $fornecedor_id;
            $this->nome = Fornecedor::find($fornecedor_id)->nome;
        }
    }

    public function editar()
    {
        try {
            Fornecedor::where('id', $this->fornecedor_id)->update([
                'nome' => mb_strtoupper($this->nome),
            ]);
            $this->msg_toast['title'] = 'Sucesso!';
            $this->msg_toast['information'] = 'Atualização realizada com sucesso!';
            $this->msg_toast['type'] = $this->toast_type['success'];
            $this->emit('showToast', $this->msg_toast);
            $this->resetExcept(['limpa']);
            $this->emit('fornecedor-table-reload');
            $this->emit('closeModal', 'editarFornecedor');

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }

    public function render()
    {
        return view('livewire.components.fornecedor.form-update');
    }
}

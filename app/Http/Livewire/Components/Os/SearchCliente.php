<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use Livewire\Component;
use App\Models\ServicoOS;
use App\Http\Classes\Configuracao;

new Configuracao();
class SearchCliente extends Component
{
    public $search = "";
    public $cliente_id = 0;
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';
    protected $listeners = [
        //'os.creloadate.reload' => '$refresh',
    ];
    //setar id cliente em outras paginas que precisam
    public function setIdCliente()
    {
        try {
            $this->emit('os.create.setIdCliente', $this->cliente_id);

       } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }

    public function render()
    {
        return view('livewire.components.os.search-cliente',[
            'clientes' => ($this->search == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search}%")->get()
        ]);
    }

}

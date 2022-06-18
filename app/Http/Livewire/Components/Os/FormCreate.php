<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;
use App\Http\Classes\Configuracao;

class FormCreate extends Component
{
    public $cliente_id = 0;
    public $search_cliente = "";
    public $search = "";
    public $servicos_add = [];
    protected $listeners = [
        'os.form-create.reload' => '$refresh',
        'os.form-create-addLista' => 'addLista'
    ];

    public function addLista($servico_id, $valor)
    {
        $valor =  trim($valor);
        $valor = (double)Configuracao::convertToMoney($valor);
        $this->servicos_add[] =  [
            'servico_id' => $servico_id,
            'valor' => $valor
        ];
        $this->emit('os.form-create.reload');
    }

    public function render()
    {
        $servico_ids = [];
        foreach($this->servicos_add as $value){
            $value = (object) $value;
            $servico_ids[] = $value->servico_id;
        }
        return view('livewire.components.os.form-create',[
            'servicos' => ($this->search == "")?[]:
            Servico::whereNotIn('id', $servico_ids)
            ->where('nome','like', "%{$this->search}%")
            ->paginate(10),
            'servicos_lista' => $this->servicos_add,
            'clientes' => ($this->search_cliente == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search_cliente}%")->get()
        ]);
    }
}

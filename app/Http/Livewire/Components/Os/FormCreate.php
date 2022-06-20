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
    public $taxas_variaveis = [];
    public $taxa_servico_nome = "";
    public $taxa_servico_id = "";
    public $taxa_servico_lista = [];
    public $taxa_valores = [];
    protected $listeners = [
        'os.form-create.reload' => '$refresh',
        'os.form-create-addLista' => 'addLista',
        'os.form-create-addTaxasLista' => 'addTaxasLista'
    ];

    public function mount()
    {
        // dd(is_object($this->taxa_servico));
    }

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

    public function removerLista($servico_id)
    {
        $i = 0;
        foreach($this->servicos_add as $value){
            $value = (object) $value;
            if($value->servico_id == $servico_id){
                $this->servicos_add = Configuracao::excluirPosicaoVetor($i, $this->servicos_add);
                break;
            }
            $i++;
        }
        $this->emit('os.form-create.reload');
    }

    public function addTaxasModal($servico_id)
    {
        $servico = Servico::find($servico_id);
        $this->taxa_servico_nome = $servico->nome;
        $this->taxa_servico_id = $servico_id;
        $this->taxas_variaveis = Servico::find($servico_id)->taxas()->where('valor_type','variavel')->get();
        $this->emit('openModal',"addTaxasVariaveis-$servico_id");
    }

    public function saveOS()
    {

    }

    public function addTaxasLista($servico_id,$taxas_ids, $taxas_value)
    {
        $atualizar = false;
        $i=0;
        foreach($this->taxa_servico_lista as $value){
            if($value['servico_id'] == $servico_id){
                $atualizar = true;
                break;
            }
            $i++;
        }
        if($atualizar){

            $this->taxa_servico_lista = Configuracao::excluirPosicaoVetor($i, $this->taxa_servico_lista);
        }
        $taxas = [];
        for($i = 0; $i < count($taxas_ids); $i++){
            $taxas[] = [
                'id' => $taxas_ids[$i],
                'valor' => $taxas_value[$i]
            ];
        }
        $this->taxa_servico_lista[] = [
            'servico_id' => $servico_id,
            'taxas' => $taxas
        ];


        $this->emit('closeModal',"addTaxasVariaveis-$servico_id");
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

<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;
use App\Models\Veiculos;
use App\Http\Classes\Configuracao;

class FormCreate extends Component
{
    public $cliente_id = 0;
    public $search_cliente = "";
    public $veiculo_id;
    public $search_veiculo = "";
    public $search = "";
    public $servicos_add = [];
    public $taxa_servico_lista = [];
    protected $listeners = [
        'os.form-create.reload' => '$refresh',
        'os.form-create-addLista' => 'addLista',
        'os.form-create-addTaxasLista' => 'addTaxasLista',
        'os.form-create-setClienteID' => 'setIdCliente'
    ];

    public function mount()
    {
        // dd(is_object($this->taxa_servico));
    }

    public function setIdCliente($cliente_id)
    {
        $this->cliente_id = $cliente_id;
        $this->emit('os.form-create.reload');
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
        //remove as taxa que são desse serviço, as taxa variavel
        $i=0;
        foreach($this->taxa_servico_lista as $value){
            if($value['servico_id'] == $servico_id){
                $this->taxa_servico_lista = Configuracao::excluirPosicaoVetor($i, $this->taxa_servico_lista);
                break;
            }
            $i++;
        }

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
        for($i = 0; $i < count($taxas_value); $i++){
            if($taxas_value[$i] > 0){
                $taxas[] = [
                    'id' => $taxas_ids[$i],
                    'valor' => $taxas_value[$i]
                ];
            }

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

            'clientes' => ($this->search_cliente == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search_cliente}%")->get(),

            'veiculos_cliente' => Veiculos::where('cliente_id', $this->cliente_id)
            ->where(function ($query) {
                $query->where('placa', 'like', "%{$this->search_veiculo}%");
                $query->orWhere('modelo', 'like', "%{$this->search_veiculo}%");
            })
            ->get()
        ]);
    }
}

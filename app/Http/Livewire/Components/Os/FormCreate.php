<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\OS;
use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;
use App\Models\Veiculos;
use App\Models\ServicoOS;
use App\Models\ServicoTaxa;
use Livewire\WithPagination;
use App\Models\TaxaVariavelOS;
use App\Http\Classes\Configuracao;

new Configuracao();
class FormCreate extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //banco
    public $cliente_id = 0;
    public $search_cliente = "";
    public $veiculo_id;
    public $search_veiculo = "";
    public $search = "";
    public $servicos_add = [];
    public $taxa_servico_lista = [];
    public $descricao = "";
    public $desconto = null;
    //variaveis de sistema
    public $valor_pago;
    public $troco =0;
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';
    protected $listeners = [
        'os.form-create.reload' => '$refresh',
        'os.form-create-addLista' => 'addLista',
        'os.form-create-addTaxasLista' => 'addTaxasLista',
        'os.form-create-setClienteID' => 'setIdCliente',
        'os.form-create-setDescricao' => 'setDescricao'
    ];

    public function mount()
    {
        // dd(is_object($this->taxa_servico));
    }

    public function setDescricao($descricao)
    {
       $this->descricao = $descricao;
    }

    public function setIdCliente($cliente_id)
    {
        $this->cliente_id = $cliente_id;
        $this->emit('veiculos.form-create.setClienteId', $this->cliente_id);
        $this->emit('os.form-create.reload');
    }

    public function veiculoClienteId()
    {
        $this->emit('veiculos.form-create.setClienteId', $this->cliente_id);
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
        //$this->emit('os.form-create.reload');
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
        try {

            $os = null;
            //verficar se tem algum serviço selecionado
            if(count($this->servicos_add) > 0){
                //criar os
                $os = OS::create([
                    'cliente_id' => $this->cliente_id,
                    'veiculo_id' => (empty($this->veiculo_id)?null:$this->veiculo_id),
                    'descricao' => $this->descricao,
                    'desconto' => Configuracao::convertToMoney($this->desconto)
                ]);
                //cadastrar servicos nas servico_os
                foreach($this->servicos_add as $value){
                    $value = (object) $value;
                    ServicoOS::create([
                        'os_id' => $os->id,
                        'servico_id' => $value->servico_id,
                        'valor_servico' => $value->valor
                    ]);
                    //cadastrar taxa fixa na 'TaxaVariavelOS', para qnd for mudar a taxa não alterar 'OS' ja criadas
                    $taxas = ServicoTaxa::where('servico_id', $value->servico_id)
                    ->where('valor_taxa', '>', 0)->get();
                    foreach($taxas as $taxa){
                        TaxaVariavelOS::create([
                            'servico_id' => $value->servico_id,
                            'taxa_id' => $taxa->taxa_id,
                            'os_id' => $os->id,
                            'valor' => $taxa->valor_taxa,
                        ]);
                    }
                }
                //verficar se tem taxas variaveis para adicionar
                if(count($this->taxa_servico_lista) > 0){
                    //cadastrar as taxas variavel do servico
                    foreach($this->taxa_servico_lista as $value){
                        $servico_id = $value['servico_id'];
                        $taxas = $value['taxas'];

                        foreach($taxas as $value){
                            TaxaVariavelOS::create([
                                'servico_id' => $servico_id,
                                'taxa_id' => $value['id'],
                                'os_id' => $os->id,
                                'valor' => $value['valor'],
                                'valor_adicional' => $value['valor_adicional']
                            ]);
                        }
                    }
                }

            }else{
                $this->msg_toast['title'] = 'Atenção!';
                $this->msg_toast['information'] = "Adicione no minímo um serviço!";
                $this->msg_toast['type'] = $this->toast_type['warning'];
                $this->emit('showToast', $this->msg_toast);
            }

            if(!empty($os)){
                $this->msg_toast['title'] = 'Sucesso!';
                $this->msg_toast['information'] = "OS Nº {$os->id} criada com sucesso!";
                $this->msg_toast['type'] = $this->toast_type['success'];
                $this->emit('showToast', $this->msg_toast);
            }

            $this->resetExcept(['limpa']);
            $this->emit('os.form-create.reload');

        } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
        }

    }

    public function addTaxasLista($servico_id,$taxas_ids, $taxas_value, $taxas_adicionais)
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
                    'valor' => $taxas_value[$i],
                    'valor_adicional' => $taxas_adicionais[$i]
                ];
            }

        }
        $this->taxa_servico_lista[] = [
            'servico_id' => $servico_id,
            'taxas' => $taxas
        ];


        $this->emit('closeModal',"addTaxasVariaveis-$servico_id");
        //$this->emit('os.form-create.reload');
    }

    public function cacularTrocoOs($total)
    {
        $valor = (double)Configuracao::convertToMoney($this->valor_pago);
        $desconto = (double) Configuracao::convertToMoney($this->desconto);
        $this->troco = $valor - ($total - $desconto);
        //dd("Valor pago: ".$this->valor_pago." Total: ".$total." Troco: ". $this->troco);
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
            ->orWhere('id',$this->search)
            ->orderBy('id', 'desc')
            ->paginate(Configuracao::$LIMITE_PAGINA),

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

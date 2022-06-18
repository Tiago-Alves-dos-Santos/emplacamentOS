<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Taxa;
use Livewire\Component;
use App\Models\ServicoTaxa;
use App\Http\Classes\Configuracao;

new Configuracao();
class TableTaxaVincular extends Component
{
    public $servico_id = 0;
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';
    protected $rules = [
        'valor_taxa' => 'required|array',
        'valor_taxa.*' => 'required',
    ];
    protected $listeners = [
        'servico.table-taxa-vincular.reload' => '$refresh',
    ];
    public function mount($servico_id)
    {
        $this->servico_id = $servico_id;
    }

    public function vincular($servico_id, $taxa_id)
    {
        $taxa = Taxa::find($taxa_id);
        try {
            ServicoTaxa::create([
                'servico_id' => $servico_id,
                'taxa_id' => $taxa_id,
                'valor_taxa' => Configuracao::convertToMoney($taxa->valor)
            ]);
            //$this->valor_taxa[$index_taxa] = "";
            $this->resetExcept(['limpa','servico_id']);
            $this->emit('servico.table-taxa-vincular.reload');
            $this->emit('servico.table-taxa-servico.reload');
        } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
        }
    }
    public function render()
    {
        $taxas_ids =ServicoTaxa::JOIN('taxas', 'taxas.id', '=', 'servico_taxas.taxa_id')
        ->where('servico_taxas.servico_id','=', $this->servico_id)
        ->select('taxa_id')
        ->get();
        $taxas = Taxa::whereNotIn('id', $taxas_ids)->get();
        return view('livewire.components.servico.table-taxa-vincular', [
            'taxas' => $taxas
        ]);
    }
}

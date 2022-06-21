<?php

namespace App\Http\Livewire\Components\Servico;

use App\Models\Servico;
use Livewire\Component;
use App\Models\ServicoTaxa;
use App\Http\Classes\Configuracao;

new Configuracao();
class TableTaxaServico extends Component
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
    protected $listeners = [
        'servico.table-taxa-servico.reload' => '$refresh',
    ];
    public function mount($servico_id)
    {
        $this->servico_id = $servico_id;
    }

    /**
     * Undocumented function
     * id da tabela servico_taxas
     * @param [int] $id
     * @return void
     */
    public function desvincular($id)
    {
        try {
            ServicoTaxa::where('id', $id)->forceDelete();
            $this->emit('servico.table-taxa-servico.reload');
            $this->emit('servico.table-taxa-vincular.reload');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.components.servico.table-taxa-servico', [
            'taxas_servico' => Servico::find($this->servico_id)
            ->taxas()
            ->get()
        ]);
    }
}

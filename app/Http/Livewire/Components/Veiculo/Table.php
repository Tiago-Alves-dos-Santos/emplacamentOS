<?php

namespace App\Http\Livewire\Components\Veiculo;

use Livewire\Component;
use App\Models\Veiculos;
use Livewire\WithPagination;
use App\Http\Classes\Configuracao;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $cliente_id;
    protected $listeners = [
        'veiculos-reload' => '$refresh',
        'veiculo.table.delete' => 'delete'
    ];

    public function mount($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function showQuestionDelete($veiculo_id)
    {
        $question = [
            'title' => 'Deletar veículo',
            'data' => 'Realmente deseja excluir o veículo de placa: <span style="color:red; white-space: nowrap;">'.Veiculos::find($veiculo_id)->placa.'</span>',
            'veiculo_id' => $veiculo_id
        ];
        $this->emit('veiculo.table.deleteVeiculo', $question);
    }

    public function delete($veiculo_id)
    {
        Veiculos::where('id', $veiculo_id)->delete();
        $this->emit('veiculos-reload');
    }

    public function render()
    {
        return view('livewire.components.veiculo.table', [
            'veiculos' => Veiculos::where('cliente_id', $this->cliente_id)->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

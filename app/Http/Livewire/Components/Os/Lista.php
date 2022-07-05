<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\OS;
use Livewire\Component;
use App\Models\ServicoOS;
use Livewire\WithPagination;
use App\Models\TaxaVariavelOS;
use App\Http\Classes\Configuracao;

new Configuracao();
class Lista extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = [
        'nome' => '',
        'id' => '',
        'created_at' => ''
    ];
    public $toast_type = ['success' => 0,'info' => 1,'warning' => 2,'error' => 3];
    public $msg_toast = [
        "title" => '',
        "information" => '',
        "type" => 1,
        "time" => TIME_TOAST
    ];
    public $limpa = '';

    protected $listeners = [
        'os-lista-reload' => '$refresh',
        'os.lista.deleteOS' => 'delete'
    ];

    public function deleteQuestion($os_id)
    {
        $question = [
            'title' => 'Deletar os',
            'data' => "Realmente deseja deletar a os Nº: <span style='color:red; white-space: nowrap;'>$os_id</span>",
            'os_id' => $os_id
        ];
        $this->emit('os.lista.delete', $question);
    }

    public function delete($os_id)
    {
        try {
            $os = OS::find($os_id);
            $servicos = $os->servicos()->get();
            foreach($servicos as $servico){
                //excluir taxas varaivel os
                foreach($servico->taxas()->get() as $taxa){
                    TaxaVariavelOS::where('taxa_id', $taxa->id)
                    ->where('servico_id', $servico->id)
                    ->where('os_id', $os->id)
                    ->delete();
                }
                //excluir serviços da os
                ServicoOS::where('id', $servico->pivot->id)->delete();
            }
            //escluir os
            $os->delete();
            $this->emit('os-lista-reload');
        } catch (\Exception $e) {
            $this->msg_toast['title'] = 'Erro!';
            $this->msg_toast['information'] = $e->getMessage();
            $this->msg_toast['type'] = $this->toast_type['error'];
            $this->emit('showToast', $this->msg_toast);
       }
    }

    public function render()
    {
        return view('livewire.components.os.lista', [
            'os' => OS::JOIN('clientes', 'clientes.id', '=', 'os.cliente_id')
            ->leftJoin('veiculos','veiculos.id','=','os.veiculo_id')
            ->where('os.id', 'like', "%{$this->search['id']}%")
            ->where('clientes.nome', 'like', "%{$this->search['nome']}%")
            ->where('os.created_at', 'like', "%{$this->search['created_at']}%")
            ->select('os.id','os.descricao','os.created_at','os.desconto','clientes.nome','veiculos.modelo','veiculos.placa')
            ->paginate(Configuracao::$LIMITE_PAGINA)
        ]);
    }
}

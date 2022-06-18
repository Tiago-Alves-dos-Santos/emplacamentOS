<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\Cliente;
use App\Models\Servico;
use Livewire\Component;

class FormCreate extends Component
{
    public $cliente_id = 0;
    public $search_cliente = "";
    public $search = "";
    protected $listeners = [
        'os.reload.reload' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.components.os.form-create',[
            'servicos' => ($this->search == "")?[]:
            Servico::where('nome','like', "%{$this->search}%")
            ->paginate(10),
            'clientes' => ($this->search_cliente == "")? Cliente::limit(50)->get() : Cliente::where('nome', 'like', "%{$this->search_cliente}%")->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components\Despeza;

use Livewire\Component;
use App\Models\Despezas;

class FiltroMensal extends Component
{
    public $mes_referente_search = null;
    public $mes_referente = null;

    protected $listeners = [
        'despeza.filtro-mensal.reload' => '$refresh',
    ];
    public function buscar()
    {
        $this->mes_referente = $this->mes_referente_search;
        $this->emit('despeza.filtro-mensal.reload');
    }

    public function render()
    {
        $mes = "";
        $ano = "";
        if(!empty($this->mes_referente)){
            $mes_referente = explode("-", $this->mes_referente);
            $mes = $mes_referente[1];
            $ano = $mes_referente[0];
        }

        return view('livewire.components.despeza.filtro-mensal',[
            'despezas' => Despezas::whereMonth('mes_referente', $mes)
            ->whereYear('mes_referente', $ano)
            ->get(),
            'total_despeza_mensal' => Despezas::whereMonth('mes_referente', $mes)
            ->whereYear('mes_referente', $ano)
            ->sum('valor')
        ]);
    }
}

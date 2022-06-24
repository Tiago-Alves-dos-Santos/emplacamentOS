<?php

namespace App\Http\Livewire\Pages;

use App\Models\OS;
use App\Models\Cliente;
use Livewire\Component;
use App\Models\Despezas;

class Dashboard extends Component
{


    public function render()
    {
        return view('livewire.pages.dashboard',[
            'total_clientes' => Cliente::count(),
            //despezas esse mes
            'total_despeza_mensal' => Despezas::whereMonth('mes_referente', date('m'))
            ->whereYear('mes_referente', date('Y'))
            ->sum('valor'),
            //os realizadas esse mes
            'os_mes_atual' => OS::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count(),
            //grafico de total - taxas e lucro das os desse mes
            'os_lucro_mensal' => OS::lucroMensal(date('m'), date('Y'))
        ])
        ->extends('layouts.admin', ['page_active' => 'home'])
        ->section('conteudo');
    }
}

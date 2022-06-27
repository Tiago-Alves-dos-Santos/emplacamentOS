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
        $data = explode('-',date('Y-m'));
        return view('livewire.pages.dashboard',[
            'total_clientes' => Cliente::count(),
            //despezas esse mes
            'total_despeza_mensal' => Despezas::whereMonth('mes_referente', $data[1])
            ->whereYear('mes_referente', $data[0])
            ->sum('valor'),
            //os realizadas esse mes
            'os_mes_atual' => OS::whereMonth('created_at', $data[1])
            ->whereYear('created_at', $data[0])
            ->count(),
            //grafico de total - taxas e lucro das os desse mes
            'os_lucro_mensal' => OS::lucroMensal($data[1], $data[0])
        ])
        ->extends('layouts.admin', ['page_active' => 'home'])
        ->section('conteudo');
    }
}

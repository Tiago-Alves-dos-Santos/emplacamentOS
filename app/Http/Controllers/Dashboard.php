<?php

namespace App\Http\Controllers;

use App\Models\OS;
use App\Models\Cliente;
use App\Models\Despezas;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data =  explode('-',$request->data);

            $total_despeza_mensal = Despezas::whereMonth('mes_referente', $data[1])
            ->whereYear('mes_referente', $data[0])
            ->sum('valor');

            $os_mes_atual = OS::whereMonth('created_at', $data[1])
            ->whereYear('created_at', $data[0])
            ->count();

            $os_lucro_mensal = OS::lucroMensal($data[1], $data[0]);

            $url = route('os.lucro-mensal', [
                'data' => $request->data,
                'total_despezas' => $total_despeza_mensal
            ]);
            $link =[
                'relatorio' => $url
            ];

            $retorno = [
                'total_despeza_mensal' => $total_despeza_mensal,
                'os_mes_atual' => $os_mes_atual,
                'os_lucro_mensal' => $os_lucro_mensal,
                'link' => $link
            ];

            return json_encode($retorno);
        }else{
            $data = explode('-',date('Y-m'));
        }

        return view('pages.dashboard', [
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
        ]);
    }

    public function dataDashboard(Request $request)
    {
        if($request->ajax()){
            $data =  explode('-',$request->data);

        }
    }
}

<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\OS;
use App\Models\Cliente;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use App\Http\Classes\Configuracao;

class PDFC extends Controller
{
    public function os(Request $request)
    {
        $os = OS::find($request->id);
        $pdf = PDF::loadView('pdf.os', compact('os'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream("os{$os->id}.pdf");
    }

    public function osOrcamento(Request $request)
    {
        $cliente = isset($request->cliente_id)?Cliente::find($request->cliente_id):[];
        $veiculo = isset($request->veiculo_id)?Veiculos::find($request->veiculo_id):[];
        $lista_servicos = isset($request->lista_servicos)?json_decode($request->lista_servicos):"";
        $lista_taxas = isset($request->lista_taxas)?json_decode($request->lista_taxas):"";
        $pdf = PDF::loadView('pdf.os-orcamento', compact(
            'cliente',
            'veiculo',
            'lista_servicos',
            'lista_taxas'
        ));
        return $pdf->stream('orçamento.pdf');

    }

    public function lucroMensal(Request $request)
    {
        $data = explode('-', $request->data);
        $total_despeza_mensal = base64_decode($request->total_despezas);
        $os_lucro_mensal = OS::lucroMensal($data[1], $data[0]);

        if(($os_lucro_mensal->lucro - $total_despeza_mensal) > 0){
            $cor_lucro = "rgb(50, 229, 92)";
        }else{
            $cor_lucro = 'rgb(219, 36, 8)';
        }

        $chartData = [
            "type" => 'pie',
              "data" => [
                "labels" => [
                    'Total',
                    'Taxas',
                    'Despezas',
                    'Lucro',
                ],
                  "datasets" => [
                    [
                        'label' => 'My First Dataset',
                        'data' => [
                                round($os_lucro_mensal->total + $os_lucro_mensal->taxas_adicionais),
                                round($os_lucro_mensal->taxas),
                                $total_despeza_mensal,
                                round($os_lucro_mensal->lucro - $total_despeza_mensal)
                            ],
                        'backgroundColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 233, 0)',
                        $cor_lucro,

                        ],
                        'hoverOffset'=> 4
                    ],
                  ],
                ]
            ];
        $chartData = json_encode($chartData);
        $chartURL = "https://quickchart.io/chart?width=300&height=200&c=".urlencode($chartData);
        $chartData = file_get_contents($chartURL);
        $chart = 'data:image/png;base64, '.base64_encode($chartData);

        $os_realizadas = OS::whereMonth('created_at', $data[1])
        ->whereYear('created_at', $data[0])
        ->count();

        $pdf = PDF::loadView('pdf.lucro-mensal', compact(
            'chart',
            'os_lucro_mensal',
            'data',
            'total_despeza_mensal',
            'os_realizadas'
        ));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream("lucro-mensal.pdf");
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>OS Nº {{$os->id}}</title>


    <style type="text/css">
       @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        body{
            padding: 10px;
            font-family: 'Nunito', sans-serif;
        }
        div{
            position: relative;
            box-sizing: border-box;
        }
        .borders{
            border:1px solid red;
        }
        .clear{
            clear: both;
        }
        div.img-back{
            position: fixed;
            top: 25%;
            left:27%;
        }
        div.img-back img{
            opacity: 0.2;
        }

        div.cabecalho{
            background-color: rgb(204, 229, 255);
            padding: 10px 5px;
            border-radius: 10px 10px 0px 0px;
        }
        div.cabecalho h3{
            float: left;
            display: inline-block;
            /* border:1px solid blue; */
        }
        div.sub-cabecalho{
            background-color:rgb(117, 186, 255);
            border-radius: 0px 0px 10px 10px;
            padding: 10px 5px;
        }

        div.servico{
            background-color:rgb(226, 227, 229);
            border-radius:4px;
            margin-top:30px;
            padding: 5px;
        }
        h3{
            font-size: 14pt
        }
        h6{
            font-size: 9pt;
        }
        .success{
            color: rgb(110, 234, 139);
        }
        .danger{
            color:#f6717c;
        }
        div.container-total{
            margin: 0 auto;
        }
        div.container-total div{
            margin: 0;
            float: left;
            width: 20%;
            height: 156px;
            display: inline-block;
            border-radius: 100%;
        }
    </style>
</head>

<body>

    <div class="img-back">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo.png'))) }}" style="width: 360px">
    </div>
    <div class="cabecalho">
        <h3 style="width: 20%">Nº {{$os->id}}</h3>
        <h3 style="width: 60%; text-align: center">{{$os->cliente->nome}}</h3>
        <h3 style="width: 19%; text-align: right">{{date('d/m/Y', strtotime($os->created_at))}}</h3>
        <div class="clear"></div>
    </div>
    @if (!empty($os->veiculo->modelo))
    <div class="sub-cabecalho">
        <h5 style="text-align: center">{{$os->veiculo->modelo}} <br> {{$os->veiculo->placa}}</h5>
    </div>
    @endif
    @php
        $servicos = $os->servicos()->get();
        $total_os = 0;
        $total_taxas_os = 0;
    @endphp
    <h3>Desconto: R$ {{Configuracao::getDbMoney($os->desconto)}}</h3>
    @forelse ($servicos as $value)
    @php
        $servico_total_valor =0;
        $servico_taxas = 0;
        $servico_taxas_adicional = 0;
        $valor_servico = 0;

        $taxas = \App\Models\TaxaVariavelOS::JOIN('taxas','taxas.id','=','taxa_variavel_os.taxa_id')
        ->select('taxa_variavel_os.valor','taxa_variavel_os.valor_adicional','taxas.nome','taxas.valor_type')
        ->where('os_id', $os->id)
        ->where('servico_id', $value->id)->get();
        foreach ($taxas as $taxa) {
            $servico_taxas_adicional += $taxa->valor_adicional;
        }
        $valor_servico += $servico_taxas_adicional;
    @endphp
    <div class="servico">
        <h3 style="font-size: 14pt">{{$value->nome}} - R$ {{Configuracao::getDbMoney($value->pivot->valor_servico + $valor_servico)}}</h3>
    </div>
    @php
       $total_os += ($value->pivot->valor_servico + $valor_servico);
    @endphp
        @forelse ($taxas as $taxa)
        <div class="" style="border: 0.3px solid rgb(162, 161, 161); padding: 5px 10px;border-radius:4px;">
            <h6 style="font-size: 13pt">{{$taxa->nome}}</h6>
            @php
                $servico_taxas += $taxa->valor;
            @endphp
                <h6 style="font-size: 12pt">Valor R$ {{Configuracao::getDbMoney($taxa->valor)}}</h6>
                <h6 style="font-size: 12pt">Adicional R$ {{Configuracao::getDbMoney($taxa->valor_adicional)}}</h6>
        </div>
        @empty

        @endforelse
        {{-- valor unico de cada serviço --}}
        @php
            $total_taxas_os += $servico_taxas;
        @endphp
        <div class="" style="float: left; margin-top:10px">
            <h6 style="display: inline-block; margin-left: 4px;font-size: 12pt" class="success">Lucro: R$ {{Configuracao::getDbMoney(($value->pivot->valor_servico + $valor_servico) - $servico_taxas)}}</h6>
            <h6 style="display: inline-block; margin-left: 4px;font-size: 12pt" class="danger">Taxas: R$ {{Configuracao::getDbMoney($servico_taxas)}}</h6>
        </div>
        <div class="clear"></div>
    @empty

    @endforelse
    @php
        $total_os -= $os->desconto;
    @endphp
    <div class="container-total" style="margin-top: 90px">
        <div class="result-total" style="border: 0.5px solid black">
            <h3 class="mr-2" style="position: relative; top:45px; left:0px; text-align: center">Total <br> R$ {{Configuracao::getDbMoney($total_os)}}</h5>
        </div>
        <div class="result-total-taxa borders" style="margin-left: 150px;">
            <h3 class="danger" style="position: relative; top:45px; left:0px; text-align: center">Taxas <br> {{Configuracao::getDbMoney($total_taxas_os)}}</h3>
        </div>
        <div class="result-total-lucro" style="margin-left: 150px; border:1px solid rgb(110, 234, 139)">
            <h3 class="success" style="position: relative; top:45px; left:0px; text-align: center">Lucro <br> R$ {{Configuracao::getDbMoney($total_os - $total_taxas_os)}}</h3>
        </div>
    </div>
    <div class="clear"></div>
    <div style="float: right; margin-top: 10px">
        <h6>Usuário: {{\App\Http\Classes\Authentication::user()->name}} em {{date('d/m/Y')}} as {{date('H:i:s')}}</h6>
    </div>
    <div class="clear"></div>


    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(515, 820, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 12);
            ');
        }
    </script>
</body>
</html>

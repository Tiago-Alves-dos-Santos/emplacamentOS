<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Orçamento</title>


    <style type="text/css">
       /* @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap'); */
        *{
            margin: 0;
            padding: 0;
        }
        body{
            padding: 10px;
            /* font-family: 'Nunito', sans-serif; */
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
        table{
            width: 98%;
        }
        th,td{
            border:1px solid black;
        }
        tr td{
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="img-back">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo.png'))) }}" style="width: 360px">
    </div>
    <div class="cabecalho">
        <h3 style="width: 98%; text-align: center">{{$cliente->nome ?? '-'}}</h3>
        <div class="clear"></div>
    </div>
    <div class="sub-cabecalho">
        <h5 style="text-align: center">{{$veiculo->modelo ?? '-'}} - {{$veiculo->placa ?? ''}}</h5>
    </div>
    @php
        $servicos = (object)$lista_servicos;
        $total_orcamento = 0;
        // $total_taxas_os = 0;
    @endphp
    <table style="margin: 30px 0px 0px 0px">
        <thead>
            <th>Serviço</th>
            <th>Valor(R$)</th>
        </thead>
        <tbody>
            @forelse ($servicos as $value)
            @php
                $servico = \App\Models\Servico::find($value->servico_id);
                $lista_taxas = (object) $lista_taxas;
                $valor_adicional = 0;
                foreach($lista_taxas as $servico_taxas){
                    if($servico_taxas->servico_id == $value->servico_id){
                        foreach($servico_taxas->taxas as $taxas){
                            $valor_adicional += (double)\App\Http\Classes\Configuracao::convertToMoney($taxas->valor_adicional);
                        }
                    }
                }
                $total_orcamento += $value->valor + $valor_adicional;
            @endphp
            <tr>
                <td>{{$servico->nome}}</td>
                <td>{{Configuracao::getDbMoney($value->valor + $valor_adicional)}}</td>
            </tr>
            @empty

            @endforelse
            <tr>
                <td style="border: none"></td>
                <td style="font-weight: bolder; font-size:18px;">
                    <span>{{Configuracao::getDbMoney($total_orcamento)}}</span>
                </td>
            </tr>
        </tbody>
        <caption>
            Desconto: R$ {{Configuracao::getDbMoney($desconto)}}<br>
            Valor Total: R$ {{($total_orcamento - $desconto)}}
        </caption>
    </table>


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

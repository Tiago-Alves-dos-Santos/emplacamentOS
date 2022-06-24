<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lucro Mensal</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        body{
            padding: 5px 10px;
            font-family: 'Poppins', sans-serif;
        }
        div{
            margin-top:30px;
        }
        .clear{
            clear: both;
        }
        .border{
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <div style="background-color:rgb(226, 227, 229);">
        <h1 style="text-align: center">Relatório de lucros</h1>
    </div>
    <div>
        <h4>Data: {{$data[1]."/".$data[0]}}</h4>
        <h4>Impresso: {{date('d/m/Y')}} às {{date('H:i:s')}}</h4>
    </div>
    <div style="margin-left: 10px">
        <ul>
            <li style="color: #f6717c">Despezas R$ {{Configuracao::getDbMoney($total_despeza_mensal)}}</li>
            <li>OS realizadas: {{$os_realizadas}}</li>
        </ul>
    </div>
    <div class="">
        <img src="{{$chart}}" style="margin-left:50px">
    </div>
</body>
</html>

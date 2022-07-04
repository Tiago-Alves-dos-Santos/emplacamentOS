<?php

namespace App\Console\Commands\Veiculo;

use App\Models\Cliente;
use App\Models\Veiculos;
use App\Models\Notification;
use Illuminate\Console\Command;

class Licenciamento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'veiculo:licenciamento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verficar se o veiculo precisa ser pago';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //a regra é pegar o ultimo numero da placa e retornar o mes de pagamento
        $data = new \DateTime();
        //retorna mes sem 0 a esquerda
        $mes_atual = $data->format('n');
        $veiculos = Veiculos::where('placa', 'like', "%$mes_atual%")->get();
        if($veiculos->count() > 0){
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            $month_name = strftime('%B', mktime(0, 0, 0, $mes_atual, 10));
            foreach($veiculos as $value){
                $final_placa = $value->placa[strlen($value->placa) - 1];
                // verifcar se final de placa é numero, mesmo se string
                if(is_numeric($final_placa) && $final_placa == $mes_atual){
                    $cliente = Cliente::find($value->cliente_id);
                    Notification::create([
                        'titulo' => 'Licenciamento',
                        'descricao' => "Licenciamneto mês de <span style='color:red'>$month_name</span> do veículo de placa <span style='color:red'>{$value->placa}</span>
                                        pertencente ao cliente <span style='color:red'>{$cliente->nome}</span>
                                        ",
                    ]);
                }
            }
        }
        return 0;
    }
}

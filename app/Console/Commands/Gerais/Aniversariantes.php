<?php

namespace App\Console\Commands\Gerais;

use App\Models\Cliente;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Http\Classes\Configuracao;

class Aniversariantes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gerais:aniversariantes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera uma notificação para cada aniversiariante do dia';

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
        $clientes = Cliente::whereMonth('data_nasc', date('m'))
        ->whereDay('data_nasc', date('d'))->get();
        if(!empty($clientes)){
            foreach($clientes as $value){
                $idade = Configuracao::calcIdade($value->data_nasc);
                Notification::create([
                    'titulo' => 'Aniversariante',
                    'descricao' => "O cliente <span style='color:red'>{$value->nome}</span> está fazendo <span style='color:red'>$idade</span> anos hoje. Deseje os parabéns!!!",
                ]);
            }
        }
    }
}

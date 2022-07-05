<?php

namespace App\Models;

use App\Models\OS;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\Veiculos;
use App\Models\ServicoOS;
use App\Models\TaxaVariavelOS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OS extends Model
{
    use HasFactory;
    use SoftDeletes;
    //pra inserção em massa
    protected $guarded = [];

    protected $table = 'os';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculos::class);
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, ServicoOS::class, 'os_id')
        ->withPivot(['id','valor_servico']);
    }


    public static function lucroMensal($mes, $ano)
    {
        $total_servicos = ServicoOS::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)->sum('valor_servico');

        $total_taxas = TaxaVariavelOS::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)->sum('valor');

        $total_taxas_adicionais = TaxaVariavelOS::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)->sum('valor_adicional');

        //total de descontos das OS
        $total_descontos = OS::where('desconto', '>', 0)
        ->whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)->sum('desconto');

        $lucro = ($total_servicos + $total_taxas_adicionais) - ($total_taxas + $total_descontos);
        $retorno = [
            'total' => ($total_servicos - $total_descontos),
            'taxas' => $total_taxas,
            'taxas_adicionais' => $total_taxas_adicionais,
            'total_descontos' => $total_descontos,
            'lucro' => $lucro
        ];
        return (object)$retorno;
    }

}

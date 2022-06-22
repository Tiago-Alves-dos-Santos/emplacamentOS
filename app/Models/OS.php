<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\Servico;
use App\Models\Veiculos;
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
        return $this->belongsToMany(Servico::class, 'servico_os', 'os_id')
        ->withPivot(['valor_servico']);
    }



}

<?php

namespace App\Models;

use App\Models\Servico;
use App\Models\ServicoTaxa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxa extends Model
{
    use HasFactory;
    use SoftDeletes;
    //pra inserção em massa
    protected $guarded = [];

    protected $table = 'taxas';

    public function servicos()
    {
        return $this->belongsToMany(Servico::class,ServicoTaxa::class)->as('servico_taxas')
        ->withPivot(['id','valor_taxa'])
    	->withTimestamps();
    }
}

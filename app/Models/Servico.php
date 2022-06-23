<?php

namespace App\Models;

use App\Models\OS;
use App\Models\Taxa;
use App\Models\ServicoOS;
use App\Models\ServicoTaxa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servico extends Model
{
    use HasFactory;
    use SoftDeletes;
    //pra inserção em massa
    protected $guarded = [];

    protected $table = 'servicos';

    public function taxas()
    {
        return $this->belongsToMany(Taxa::class,ServicoTaxa::class)->as('servico_taxas')
        ->withPivot(['id','valor_taxa'])
    	->withTimestamps();
    }

    public function os()
    {
        return $this->belongsToMany(OS::class, ServicoOS::class)
        ->withPivot(['id','valor_servico']);
    }

}

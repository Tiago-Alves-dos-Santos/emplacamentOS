<?php

namespace App\Models;

use App\Models\Taxa;
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
        return $this->belongsToMany(Taxa::class,'servico_taxas')->as('servico_taxas');
    }

}

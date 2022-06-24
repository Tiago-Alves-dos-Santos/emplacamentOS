<?php

namespace App\Models;

use App\Models\Despezas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model
{
    use HasFactory;
    use SoftDeletes;
    //pra inserção em massa
    protected $guarded = [];

    protected $table = 'fornecedor';


    public function despezas()
    {
        return $this->hasMany(Despezas::class);
    }

}

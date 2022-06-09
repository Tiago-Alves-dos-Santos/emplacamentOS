<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despezas extends Model
{
    use HasFactory;
    use SoftDeletes;
    //pra inserção em massa
    protected $guarded = [];

    protected $table = 'despezas';
}

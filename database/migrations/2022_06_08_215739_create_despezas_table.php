<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespezasTable extends Migration
{
    /**
     * Run the migrations. 8
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despezas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fornecedor_id')->unsigned()->nullable();
            $table->string('nome',255)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despezas');
    }
}

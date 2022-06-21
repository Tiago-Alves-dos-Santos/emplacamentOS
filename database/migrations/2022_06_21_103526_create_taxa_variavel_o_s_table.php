<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaVariavelOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxa_variavel_os', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('servico_id')->unsigned()->nullable();
            $table->bigInteger('taxa_id')->unsigned()->nullable();
            $table->bigInteger('os_id')->unsigned()->nullable();
            $table->double('valor', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('taxa_id')->references('id')->on('taxas');
            $table->foreign('os_id')->references('id')->on('os');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxa_variavel_os');
    }
}

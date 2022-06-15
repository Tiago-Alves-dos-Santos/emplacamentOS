<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicoTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servico_taxas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('servico_id')->unsigned()->nullable();
            $table->bigInteger('taxa_id')->unsigned()->nullable();
            $table->double('valor_taxa', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //forengKeys
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('taxa_id')->references('id')->on('taxas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servico_taxas');
    }
}

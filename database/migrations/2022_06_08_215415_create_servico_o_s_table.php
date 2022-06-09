<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicoOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servico_os', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('os_id')->unsigned()->nullable();
            $table->bigInteger('servico_id')->unsigned()->nullable();
            $table->double('valor_servico', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //forengKeys
            $table->foreign('os_id')->references('id')->on('os');
            $table->foreign('servico_id')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servico_os');
    }
}

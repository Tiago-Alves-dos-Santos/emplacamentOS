<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOSTable extends Migration
{
    /**
     * Run the migrations. 4
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->nullable();
            $table->text('descricao')->nullable();
            $table->double('emplcamento_valor', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os');
    }
}

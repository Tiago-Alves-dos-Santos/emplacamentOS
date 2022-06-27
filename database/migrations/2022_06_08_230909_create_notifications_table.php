<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',255)->nullable();
            $table->text('descricao')->nullable();
            $table->string('tabela',255)->nullable();
            $table->bigInteger('id_destino')->unsigned()->nullable();//se id for nulo, mandar notificação pra geral
            $table->enum('lida', ['S', 'N'])->default('N');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

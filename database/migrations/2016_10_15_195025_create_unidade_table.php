<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {

            $table->increments('id');

            $table->string('numero_unidade');

            $table->integer('id_responsavel');

            $table->double('metragem');

            $table->integer('quantidade_comodos');

            $table->string('numero_matricula');

            $table->boolean('situacao');

            $table->integer('id_bloco')->unsigned();

            $table->foreign('id_bloco')->references('id')->on('blocos');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("unidades");
    }
}

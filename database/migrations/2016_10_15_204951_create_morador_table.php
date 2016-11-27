<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moradores', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_unidade');

            $table->date('data_entrada');

            $table->string('nome_completo');

            $table->string('cpf');

            $table->string('rg');

            $table->string('telefone_1');

            $table->string('telefone_2');

            $table->string('telefone_3');

            $table->string('profissao');

            $table->date('data_nascimento');

            $table->string('sexo');

            $table->string('email');

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
        Schema::drop("moradores");
    }
}

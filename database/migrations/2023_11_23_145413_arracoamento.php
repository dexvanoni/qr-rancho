<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Arracoamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_comanda')->create('arracoamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf');
            $table->string('dia_semana');
            $table->string('data_arrac');
            $table->string('refeicao');
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
        Schema::connection('mysql_comanda')->dropIfExists('arracoamentos');
    }
}

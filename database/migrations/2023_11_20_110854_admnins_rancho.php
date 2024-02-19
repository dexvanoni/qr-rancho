<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdmninsRancho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_comanda')->create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf');
            $table->string('posto_grad');
            $table->string('nome_guerra');
            $table->string('nome_completo');
            $table->string('contato');
            $table->string('setor');
            $table->string('email');
            $table->string('senha');
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
        Schema::connection('mysql_comanda')->dropIfExists('fiscais');
    }
}

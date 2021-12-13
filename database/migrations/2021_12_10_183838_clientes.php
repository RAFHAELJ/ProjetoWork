<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->comment('Nome do cliente');
            $table->string('tipo', 10)->comment('TpC. Física ou Jurídica');
            $table->string('estado', 2)->comment('Unidade da Federação');
            $table->integer('categoria_id')->comment('Categoria');
            $table->date('Inicio')->comment('Fundacao PJ/Nascimento para PF');
            $table->string('telefone', 255)->comment('Telefones do cliente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbienteComplementoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente_complemento', function (Blueprint $table) {
          $table->integer('ambiente_id')->unsigned();
          $table->integer('complemento_id')->unsigned();

          $table->foreign('ambiente_id')->references('id')->on('ambientes')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('complemento_id')->references('id')->on('complementos')
              ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ambiente_complementos');
    }
}

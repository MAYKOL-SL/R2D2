<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbienteComplementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente_complementos', function (Blueprint $table) {
          $table->integer('ambiente_id')->unsigned();
          $table->integer('complemento_id')->unsigned();

          $table->foreign('ambiente_id')->references('id')->on('ambientes')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('complemento_id')->references('id')->on('complementos')
              ->onUpdate('cascade')->onDelete('cascade');

          $table->primary(['ambiente_id', 'complemento_id']);
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

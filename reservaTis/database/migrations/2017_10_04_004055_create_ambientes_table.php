<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->increments('id');
            /*title es nombre aula*/
            $table->string('title',50);
            $table->string('imagen',200);
             $table->integer('capacidad');
              $table->string('ubicacion',50);
            $table->timestamps();

            $table->integer('tipo_ambiente_id')->unsigned();
              $table->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ambientes');
    }
}

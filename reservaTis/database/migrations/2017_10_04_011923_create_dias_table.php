<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombre_dia',50);
              $table->string('fecha_dia',50);
            $table->timestamps();

            $table->integer('periodo_id')->unsigned();
              $table->foreign('periodo_id')->references('id')->on('periodos')
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
        Schema::drop('dias');
    }
}

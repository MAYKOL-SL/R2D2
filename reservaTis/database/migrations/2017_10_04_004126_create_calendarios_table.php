<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->increments('id');
             $table->date('Fecha',50)->nullable();
             $table->string('Dia',50)->nullable();
             $table->string('Actividad',300)->nullable();
            $table->timestamps();

            //$table->integer('tipo_fecha_id')->unsigned();
             // $table->foreign('tipo_fecha_id')->references('id')->on('tipo_fechas')
           // ->onUpdate('CASCADE')
           // ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendarios');
    }
}

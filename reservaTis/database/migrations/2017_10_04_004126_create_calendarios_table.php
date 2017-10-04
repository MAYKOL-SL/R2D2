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
             $table->string('mes',50);
              $table->string('ano',50);
               $table->string('dia',50);
            $table->timestamps();

            $table->integer('tipo_fecha_id')->unsigned();
              $table->foreign('tipo_fecha_id')->references('id')->on('tipo_fechas')
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
        Schema::drop('calendarios');
    }
}

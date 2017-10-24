<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('reserva_id')->unsigned();
            $table->foreign('reserva_id')->references('id')->on('reservas')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('calendario_id')->unsigned();
            $table->foreign('calendario_id')->references('id')->on('calendarios')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('periodo_id')->unsigned();
              $table->foreign('periodo_id')->references('id')->on('periodos')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('ambiente_id')->unsigned();
              $table->foreign('ambiente_id')->references('id')->on('ambientes')
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
        Schema::drop('detalle_reservas');
    }
}

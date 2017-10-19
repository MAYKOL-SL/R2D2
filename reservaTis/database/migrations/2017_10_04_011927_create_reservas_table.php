<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombre_reseva',500);
              $table->string('descripcion',500);
            $table->timestamps();

            $table->integer('calendario_id')->unsigned();
              $table->foreign('calendario_id')->references('id')->on('calendarios')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('dia_id')->unsigned();
            $table->foreign('dia_id')->references('id')->on('dias')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('ambiente_id')->unsigned();
              $table->foreign('ambiente_id')->references('id')->on('ambientes')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->integer('user_id')->unsigned();
              $table->foreign('user_id')->references('id')->on('users')
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
        Schema::drop('reservas');
    }
}

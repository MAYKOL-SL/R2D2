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
           $table->string('description',500);
           /*start = fecha inicio*/
           $table->date('start');
           /*start = fecha fin*/
           $table->date('end');
            $table->timestamps();

            
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

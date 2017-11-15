<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullcalendareventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullcalendareventos', function (Blueprint $table) {
            $table->increments('id_event');
            $table->date('start');
            $table->date('end')->nullable();
            $table->mediumText('title')->nullable();
            $table->string('color')->nullable();
            $table->string('id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fullcalendareventos');
    }
}

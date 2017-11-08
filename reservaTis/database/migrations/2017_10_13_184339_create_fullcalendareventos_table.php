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
            $table->increments('id');
            $table->datetime('start');
            $table->datetime('end')->nullable();
            $table->mediumText('title')->nullable();
            $table->string('color')->nullable();
            $table->mediumText('aula')->nullable();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entitats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('nom_activitat');
            $table->date('data_inici');
            $table->date('data_final');
            $table->text('curs_escolar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entitats');
    }
}

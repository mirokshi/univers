<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alumnes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('cognom')->nullable();
            $table->date('data_naiximent')->nullable();
            $table->integer('edad')->nullable();
            $table->text('centre_educatiu')->nullable();
            $table->text('curs_realitza')->nullable();
            $table->text('curs_escolar')->nullable();
            $table->text('sexe')->nullable();
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
        Schema::dropIfExists('alumnes');
    }
}

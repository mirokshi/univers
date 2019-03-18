<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activitats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_final')->nullable();
            $table->string('course')->nullable();
            $table->unsignedInteger('user_id') ->nullable();
            $table->timestamps();
        });
        Schema::create('activitat_alumne',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('alumne_id');
            $table->unsignedInteger('activitat_id');
            $table->index(['alumne_id','activitat_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitats');
        Schema::dropIfExists('activitat_alumne');
    }
}

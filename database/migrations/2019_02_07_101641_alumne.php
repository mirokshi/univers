<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alumne extends Migration
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
            $table->string('name');
            $table->string('surname')->nullable();
            $table->date('birthdate');
            $table->integer('age')->nullable();
            $table->text('school')->nullable();
            $table->text('course')->default(date('Y').'-'.(date('Y')+1));
            $table->text('school_course')->nullable();
            $table->text('sex')->nullable();
            $table->integer('phone')->nullable();
            $table->unsignedInteger('user_id') ->nullable();
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

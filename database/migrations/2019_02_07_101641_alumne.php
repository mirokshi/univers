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
        $date = date('Y').'-'.(date('Y')+1);
        Schema::create('alumnes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->text('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->text('school')->nullable();
            $table->text('course')->nullable();
            $table->text('school_course')->nullable();
            $table->text('sex')->nullable();
            $table->integer('phone')->nullable();
            $table->boolean('change')->nullable()->default(true);
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

<?php

use Carbon\Carbon;
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
            $table->string('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->string('school')->nullable();
            $table->string('course')->nullable()->default(date('Y').'-'.(date('Y')+1));
            $table->string('school_course')->nullable();
            $table->string('sex')->nullable();
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

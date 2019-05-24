<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumneTable extends Migration
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
            $table->string('surname');
            $table->unique(['name','surname']);
            $table->string('birthdate');
            $table->integer('age');
            $table->string('school');
            $table->string('course')->default(date('Y').'-'.(date('Y')+1));
            $table->string('school_course');
            $table->enum('sex',['Dona','Home', 'Altre']);
            $table->integer('phone')->nullable();
            $table->boolean('change')->default(true);
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

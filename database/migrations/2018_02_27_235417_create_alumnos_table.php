<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idgrupo')->unsigned();
            $table->string('nombre', 100);
            $table->string('apaterno', 100)->nullable();
            $table->string('amaterno', 100)->nullable();
            $table->string('num_alumno', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->string('num_ide', 20)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('sexo', 50)->nullable();
            $table->string('edad', 50)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idgrupo')->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}

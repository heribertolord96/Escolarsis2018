<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesions', function (Blueprint $table)
         {
            $table->increments('id');
            $table->integer('idalumno')->unsigned();
            $table->integer('idcurso')->unsigned();
            $table->integer('idmateria')->unsigned();
            $table->string('calificacion', 100)->nullable();
            $table->string('asistencia', 100)->nullable();
            $table->string('conducta', 20)->nullable();
            $table->integer('idperiodo')->unsigned()->nullable();
            $table->date('fecha')->nullable();
           
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idcurso')->references('id')->on('cursos');
            $table->foreign('idalumno')->references('id')->on('alumnos');
            $table->foreign('idmateria')->references('id')->on('materias');
            $table->foreign('idperiodo')->references('id')->on('periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promedios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idperiodo')->unsigned();
            $table->integer('idalumno')->unsigned();
            $table->integer('idcurso')->unsigned();
            $table->integer('idmateria')->unsigned();
            $table->integer('idsesion')->unsigned();
            $table->string('promedio', 100)->nullable();
            $table->boolean('condicion')->default(1);

            $table->timestamps();
            $table->foreign('idalumno')->references('id')->on('alumnos');
            $table->foreign('idcurso')->references('id')->on('cursos');
            $table->foreign('idmateria')->references('id')->on('materias');
            $table->foreign('idsesion')->references('id')->on('sesions');
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
        Schema::dropIfExists('promedios');
    }
}

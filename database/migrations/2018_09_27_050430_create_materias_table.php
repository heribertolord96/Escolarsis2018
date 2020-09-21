<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('idcurso')->unsigned();
            $table->integer('idpersona')->unsigned();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 900)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idcurso')->references('id')->on('cursos');
            $table->foreign('idpersona')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}

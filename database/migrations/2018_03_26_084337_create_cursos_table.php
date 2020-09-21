<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('idcategoria')->unsigned();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 900)->nullable();
            $table->boolean('condicion')->default(1);       
            $table->timestamps();
            //$table->foreign('idalumno')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}

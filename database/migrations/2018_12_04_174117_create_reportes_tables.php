<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTables extends Migration
{
    
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idalumno')->unsigned();
            $table->string('nombre', 100)->nullable();
            $table->date('fecha')->nullable();
            $table->string('descripcion', 900)->nullable();
            $table->boolean('condicion')->default(1);  
            $table->integer('autor')->nullable();         
            $table->timestamps();
            $table->foreign('idalumno')->references('id')->on('alumnos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}

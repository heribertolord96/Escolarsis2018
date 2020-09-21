<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idgrupo')->unsigned();
            $table->integer('idcurso')->unsigned();
            $table->boolean('condicion')->default(1);
            $table->unique(['idgrupo', 'idcurso']);
            $table->timestamps();
            $table->foreign('idgrupo')->references('id')->on('grupos');
            $table->foreign('idcurso')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}

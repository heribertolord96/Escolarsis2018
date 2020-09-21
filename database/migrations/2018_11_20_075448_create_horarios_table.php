<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcurso')->unsigned();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 5000)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('horarios');
    }
}

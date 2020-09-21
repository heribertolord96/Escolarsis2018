<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nump', 100)->nullable();
            $table->integer('idmateria')->unsigned()->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idmateria')->references('id')->on('materias');//idescuela
        });
        /*DB::table('periodos')->insert(array('id'=>'1','nump'=>'1'));
            DB::table('periodos')->insert(array('id'=>'2','nump'=>'2'));
            DB::table('periodos')->insert(array('id'=>'3','nump'=>'3'));
            DB::table('periodos')->insert(array('id'=>'4','nump'=>'4'));
            DB::table('periodos')->insert(array('id'=>'5','nump'=>'5'));
            DB::table('periodos')->insert(array('id'=>'6','nump'=>'6'));
            DB::table('periodos')->insert(array('id'=>'7','nump'=>'7'));
            DB::table('periodos')->insert(array('id'=>'8','nump'=>'8'));*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');//->start_from(140000);;
            $table->integer('id1')->unsigned()->nullable();
            $table->integer('id2')->unsigned()->nullable();
            $table->foreign('id1')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id2')->references('id')->on('alumnos')->onDelete('cascade');
            $table->string('usuario')->unique();
            $table->string('password');
            $table->boolean('condicion')->default(1);
            $table->integer('idrol')->unsigned();
            $table->foreign('idrol')->references('id')->on('roles');        
            $table->rememberToken();
            //$table->timestamps();
        });
        DB::table('users')->insert(array('id'=>'1','id1'=>'1', 'usuario'=>'user1','password'=>'$2y$10$f2dUEjuXWTut6krgS65EFewZc8BVT3S/vC1MD11INNpVP/3AyMtcq','idrol'=>'1'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            //maestro
            $table->string('nombre', 100)->nullable();
            $table->string('tipo_documento', 20)->nullable();
            $table->string('num_documento', 20)->nullable();
            $table->string('cargo', 20)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 50)->nullable();
                       
            $table->timestamps();           
        }); 
        
        DB::statement("ALTER TABLE personas AUTO_INCREMENT = 1488000;");
        DB::table('personas')->insert(array('id'=>'1','nombre'=>'Rolando Gallo', 'tipo_documento'=>'','cargo'=>'maestro','direccion'=>'enrique segoviano'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}

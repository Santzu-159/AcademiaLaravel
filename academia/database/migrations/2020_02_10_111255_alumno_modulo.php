<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlumnoModulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_modulo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("alumno_id")->unsigned();
            $table->bigInteger("modulo_id")->unsigned();
            $table->float("nota",4,2)->nullable();
            $table->timestamps();

            //Creamos la foreignkey
            $table->foreign("alumno_id")
                ->references("id")
                ->on("alumnos")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("modulo_id")
                ->references("id")
                ->on("modulos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_modulo');
        
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('urltarea');
            $table->string('calificacion');
            $table->string('estado');
            $table->integer('idestudiante');
            $table->string('valor');
            $table->string('descripcion');
            $table->string('fecha_creacion');
            $table->string('fecha_vencimiento');
            $table->integer('idprofesor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}

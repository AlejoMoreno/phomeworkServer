<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('actividades');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('tipo_usuarios')->insert(
            array('id'=>63, 'nombre'=>'ADMINISTRADOR', 'actividades'=>'ADMINISTRAR')
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
}

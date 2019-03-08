<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_admin');
            $table->string('cedula');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('clave');
            $table->string('correo');
            $table->string('estado');
            $table->integer('idtipo_usuario');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('administradores')->insert(
            array('id'=>2, 'nombre_admin'=>'FREDY', 'cedula'=>'1030570356', 'telefono'=>'3219045297', 'direccion'=>'CL 38 A 50 A 71 SUR', 'clave'=>'1234', 'correo'=>'FREDYMORENO@UAN.EDU.CO', 'estado'=>'1', 'idtipo_usuario'=>63)
        );
        // Insert some stuff
        DB::table('administradores')->insert(
            array('id'=>5, 'nombre_admin'=>'ALEJANDRO MORENO CASTRO', 'cedula'=>'1030570356', 'telefono'=>'3219045297', 'direccion'=>'CL 38 A 50 A 71 SUR', 'clave'=>'1234', 'correo'=>'FREDYMORENO@UAN.EDU.CO', 'estado'=>'1', 'idtipo_usuario'=>63)
        );
        // Insert some stuff
        DB::table('administradores')->insert(
            array('id'=>7, 'nombre_admin'=>'admin', 'cedula'=>'0', 'telefono'=>'0', 'direccion'=>'0', 'clave'=>'admin', 'correo'=>'0', 'estado'=>'0', 'idtipo_usuario'=>63)
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradores');
    }
}

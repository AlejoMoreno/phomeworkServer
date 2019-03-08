<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('urlFoto');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('urlCertificado');
            $table->integer('estado');
            $table->string('idadministrador');
            $table->string('idareasEspecialista');
            $table->string('clave');
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('cuenta');
            $table->string('tipocuenta');
            $table->string('banco');
            $table->timestamps();
        });
        // Insert some stuff
        DB::table('profesores')->insert(
            array('nombre'=>'admin', 'apellido'=>'admin', 'urlFoto'=>'admin', 'correo'=>'admin', 
            'telefono'=>'admin', 'direccion'=>'admin', 'urlCertificado'=>'admin', 'estado'=>2, 'idadministrador'=>2, 'idareasEspecialista'=>12, 
            'clave'=>'389c96dcef754f01bc2d49a8007c4a3f', 'descripcion'=>'admin', 'tipo'=>'null', 'cuenta'=>'NULL', 'tipocuenta'=>'NULL', 'banco'=>'NULL')
        );
        // Insert some stuff
        DB::table('profesores')->insert(
            array('nombre'=>'admin1', 'apellido'=>'admin1', 'urlFoto'=>'1admin1', 'correo'=>'1admin', 
            'telefono'=>'admin1', 'direccion'=>'admin1', 'urlCertificado'=>'admin1', 'estado'=>2, 'idadministrador'=>2, 'idareasEspecialista'=>12, 
            'clave'=>'389c96dcef754f01bc2d49a8007c4a3f', 'descripcion'=>'admin1', 'tipo'=>'null', 'cuenta'=>'NULL', 'tipocuenta'=>'NULL', 'banco'=>'NULL')
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesores');
    }
}

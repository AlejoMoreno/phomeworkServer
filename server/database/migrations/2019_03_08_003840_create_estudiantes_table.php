<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('edad');
            $table->string('telefono');
            $table->string('correo');
            $table->string('clave');
            $table->string('PAYER_DNI');
            $table->string('tipo');
            $table->integer('tokens');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('estudiantes')->insert(
            array('nickname'=>'admin', 'edad'=>'admin', 'telefono'=>'admin', 'correo'=>'admin', 'clave'=>'admin', 'PAYER_DNI'=>'admin', 'tipo'=>'', 'tokens'=>50)
        );
        // Insert some stuff
        DB::table('estudiantes')->insert(
            array('nickname'=>'admin1', 'edad'=>'admin1', 'telefono'=>'admin1', 'correo'=>'admin1', 'clave'=>'a1dmin', 'PAYER_DNI'=>'1admin', 'tipo'=>'1', 'tokens'=>50)
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}

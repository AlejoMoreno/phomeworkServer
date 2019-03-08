<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasespecialistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areasespecialistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('dificultad');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('areasespecialistas')->insert(
            array('id'=>11, 'nombre'=>'INFORMÃTICA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>12, 'nombre'=>'INGLÃ‰S', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>14, 'nombre'=>'CONTABILIDAD', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>15, 'nombre'=>'MANUALIDADES', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>19, 'nombre'=>'FÃSICA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>20, 'nombre'=>'QUÃMICA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>21, 'nombre'=>'ESPAÃ‘OL', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>22, 'nombre'=>'BIOLOGÃA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>23, 'nombre'=>'FILOSIFÃA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>24, 'nombre'=>'MATEMÃTICAS', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>25, 'nombre'=>'ESTADÃSTICA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>26, 'nombre'=>'DERECHO', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>27, 'nombre'=>'MEDICINA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>28, 'nombre'=>'ECONOMÃA', 'dificultad'=>'10')
        );
        DB::table('areasespecialistas')->insert(
            array('id'=>29, 'nombre'=>'FRANCÃ‰S', 'dificultad'=>'10')
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areasespecialistas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idestudiante');
            $table->string('valor');
            $table->string('signo');
            $table->integer('saldo');
            $table->string('reference_pol');
            $table->string('transactionId');
            $table->string('responseCode');
            $table->string('FIRMA');
            $table->string('EMAILPAYER');
            $table->string('DESCRIPTION');
            $table->string('REFERENCE_CODE');
            $table->string('fecha_creation');
            $table->string('lapTransactionState');
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
        Schema::dropIfExists('pagos');
    }
}

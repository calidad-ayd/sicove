<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('advances', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->integer('treatment_id')->unsigned();
            $table->string('periodicidad');
            $table->integer('periodoModif');
            $table->integer('dosis');
            $table->string('observaciones');
            $table->timestamps();
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advances');
        $table->dropForeign('advances_treatment_id_foreign');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiseaseEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_entries', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->date('fecha_diagnostico');
            $table->integer('estado_avance')->default(0);
            $table->integer('pet_id');
            $table->integer('disease_id');
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
        Schema::dropIfExists('disease_entries');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string("nombre");
            $table->integer("tipoDeAnimal");
            $table->string("raza");
            $table->date("fechaNacimiento");
            $table->string("foto")->nullable();
            $table->string("client_id");
            //$table->foreign('client_id')->references('id')->on('clients');
            
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
        Schema::dropIfExists('pet');
    }
}

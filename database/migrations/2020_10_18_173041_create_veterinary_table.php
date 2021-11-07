<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeterinaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veterinaries', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string("nombre");
            $table->string("primerApellido");
            $table->string("segundoApellido");
            $table->string("correo");
            $table->string("telefono");

            //$table->primary('id');
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
        Schema::dropIfExists('veterinaries');
    }
}

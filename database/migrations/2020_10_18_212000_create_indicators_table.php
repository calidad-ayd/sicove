<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('fechaConsulta');
            $table->float('peso');
            $table->float('temperatura');
            $table->float('estatura');
            $table->integer('pet_id');
            $table->timestamps();
           $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicators');
    }
    
}

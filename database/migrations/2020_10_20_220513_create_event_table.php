<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('fechaCita');
            $table->time('horaCita');
            $table->integer('veterinary_id');
            $table->integer('pet_id');
            $table->string('descripcion');
            $table->timestamps();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('veterinary_id')->references('id')->on('veterinaries')->onDelete('cascade');
            //$table->primary(['veterinary_id','fechaCita','horaCita']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

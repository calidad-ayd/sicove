<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnIndicators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicators', function (Blueprint $table) {
            // $table->integer('id')->autoIncrement();
            //$table->date('fechaConsulta');
            // $table->float('peso');
            //$table->float('temperatura');
            //$table->float('estatura');
            //$table->integer('pet_id');
            $table->dropColumn('peso');
            $table->dropColumn('temperatura');
            $table->dropColumn('estatura');
            $table->integer('tipo');
            $table->float('valor');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('valor');
        });
    }
}

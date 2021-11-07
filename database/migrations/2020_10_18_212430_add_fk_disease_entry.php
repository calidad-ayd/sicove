<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkDiseaseEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disease_entries', function(Blueprint $table) {

            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('disease_entries_pet_id_foreign');
        $table->dropForeign('disease_entries_disease_id_foreign');
    }
}

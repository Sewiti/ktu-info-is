<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePakvietimaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakvietimai', function (Blueprint $table) {
            $table->id();
            $table->string('nuoroda');
            $table->integer('pakviesta_zmoniu')->default(0);
            $table->double('nuolaida')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakvietimai');
    }
}

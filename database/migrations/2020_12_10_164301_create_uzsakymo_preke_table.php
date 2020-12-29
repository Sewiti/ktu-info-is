<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUzsakymoPrekeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzsakymo_preke', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uzsakymo_id');
            $table->foreign('uzsakymo_id')->references('id')->on('uzsakymas')->onDelete('CASCADE');
            $table->integer('kiekis');
            $table->double('kaina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uzsakymo_preke');
    }
}

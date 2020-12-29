<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusenaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busena', function (Blueprint $table) {
            $table->id();
            $table->dateTime('atnaujinimo_laikas');
            $table->unsignedBigInteger('busena')->default(1);
            $table->foreign('busena')->references('id')->on('uzsakymo_statusas')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('busena');
    }
}

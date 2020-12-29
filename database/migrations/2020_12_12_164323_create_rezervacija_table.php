<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRezervacijaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rezervacija', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('darbuotojas');
            $table->foreign('darbuotojas')->references('id')->on('vartotojai')->onDelete('CASCADE');
            $table->dateTime('pradzios_laikas');
            $table->dateTime('pabaigos_laikas');
            $table->unsignedBigInteger('statusas')->default(5);
            $table->foreign('statusas')->references('id')->on('statusas')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rezervacija');
    }
}

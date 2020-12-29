<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVartotojaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vartotojai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pakviestas')->nullable();
            $table->foreign('pakviestas')->references('id')->on('vartotojai')->onDelete('CASCADE');
            $table->string('vardas');
            $table->string('pavarde');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('vartotojo_tipas')->default(1);
            $table->foreign('vartotojo_tipas')->references('id')->on('vartotojo_tipas')->onDelete('CASCADE');
            $table->string('adresas')->nullable();
            $table->string('miestas')->nullable();
            $table->string('salis')->nullable();
            $table->string('pasto_kodas')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('statusas')->default(5);
            $table->foreign('statusas')->references('id')->on('statusas')->onDelete('CASCADE');
            $table->unsignedBigInteger('pakvietimas')->nullable();
            $table->foreign('pakvietimas')->references('id')->on('pakvietimai')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vartotojai');
    }
}

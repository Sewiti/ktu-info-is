<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUzduotisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzduotis', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
            $table->text('aprasas');
            $table->timestamps();
            $table->unsignedBigInteger('statusas')->default(3);
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
        Schema::dropIfExists('uzduotis');
    }
}

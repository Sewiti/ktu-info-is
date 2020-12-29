<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZinuteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zinute', function (Blueprint $table) {
            $table->id();
            $table->text('tekstas');
            $table->unsignedBigInteger('siuncia');
            $table->foreign('siuncia')->references('id')->on('vartotojai')->onDelete('cascade');
            $table->unsignedBigInteger('gauna');
            $table->foreign('gauna')->references('id')->on('vartotojai')->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('statusas')->default(1);
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
        Schema::dropIfExists('zinute');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePrekesStatusasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prekes_statusas', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
        });

        DB::table('prekes_statusas')->insert([
            ['pavadinimas' => 'Turime sandelyje'],
            ['pavadinimas' => 'Neturime sandelyje'],
            ['pavadinimas' => 'Turėsime greitu metu'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prekes_statusas');
    }
}

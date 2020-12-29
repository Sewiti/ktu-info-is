<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKategorijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategorijos', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
        });

        DB::table('kategorijos')->insert([
            ['pavadinimas' => 'Personaliniai Kompiuteriai'],
            ['pavadinimas' => 'Mobiliųjų Dalys'],
            ['pavadinimas' => 'Nešiojami Kompiuteriai'],
            ['pavadinimas' => 'Kompiuterių Komponentai'],
            ['pavadinimas' => 'Mobilieji telefonai'],
            ['pavadinimas' => 'Priedai'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategorijos');
    }
}

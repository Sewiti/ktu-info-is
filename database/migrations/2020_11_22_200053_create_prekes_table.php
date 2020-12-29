<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Prekes;

class CreatePrekesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prekes', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
            $table->unsignedBigInteger('kategorija');
            $table->longText('aprasas');
            $table->double('kaina');
            $table->text('pagrindine_nuotrauka');
            $table->unsignedBigInteger('statusas')->default(1);
            $table->timestamps();

            $table->foreign('kategorija')->references('id')->on('kategorijos')->onDelete('RESTRICT');
            $table->foreign('statusas')->references('id')->on('prekes_statusas')->onDelete('RESTRICT');
        });


        DB::table('prekes')->insert([
            'id' => 1,
            'pavadinimas' => 'Pirmoji Prekė',
            'kategorija' => 1,
            'aprasas' => 'Pirmosios prekės aprašymas',
            'kaina' => 11.99,
            'pagrindine_nuotrauka' => 'images/product_1.png',
            'data_sukurta' => '2020-11-22 21:09:50',
            'data_atnaujinta' => '2020-11-22 21:09:50'
        ]);

        DB::table('prekes')->insert([
            'id' => 2,
            'pavadinimas' => 'Antroji Prekė',
            'kategorija' => 2,
            'aprasas' => 'Antrosios prekės aprašymas',
            'kaina' => 11.99,
            'pagrindine_nuotrauka' => 'images/product_2.png',
            'data_sukurta' => '2020-11-22 21:11:29',
            'data_atnaujinta' => '2020-11-22 21:11:29'
        ]);

        DB::table('prekes')->insert([
            'id' => 3,
            'pavadinimas' => 'Trečioji Prekė',
            'kategorija' => 3,
            'aprasas' => 'Trečiosios prekės aprašymas',
            'kaina' => 11.99,
            'pagrindine_nuotrauka' => 'images/product_3.png',
            'data_sukurta' => '2020-11-22 21:11:29',
            'data_atnaujinta' => '2020-11-22 21:11:29'
        ]);

        DB::table('prekes')->insert([
            'id' => 4,
            'pavadinimas' => 'Ketvirtoji Prekė',
            'kategorija' => 4,
            'aprasas' => 'Ketvirtosios prekės aprašymas',
            'kaina' => 11.99,
            'pagrindine_nuotrauka' => 'images/product_4.png',
            'data_sukurta' => '2020-11-22 21:11:29',
            'data_atnaujinta' => '2020-11-22 21:11:29'
        ]);

        DB::table('prekes')->insert([
            'id' => 5,
            'pavadinimas' => 'Penktoji prekė',
            'kategorija' => 5,
            'aprasas' => 'Pirmosios prekės aprašymas',
            'kaina' => 21.99,
            'pagrindine_nuotrauka' => 'images/product_5.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 6,
            'pavadinimas' => 'Šeštoji prekė',
            'kategorija' => 6,
            'aprasas' => 'Šeštosios prekės aprašymas',
            'kaina' => 69.99,
            'pagrindine_nuotrauka' => 'images/product_6.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 7,
            'pavadinimas' => 'Testinė prekė 7',
            'kategorija' => 1,
            'aprasas' => 'prekės aprašymas 7',
            'kaina' => 0.99,
            'pagrindine_nuotrauka' => 'images/product_7.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 8,
            'pavadinimas' => 'Testinė prekė 8',
            'kategorija' => 2,
            'aprasas' => 'prekės aprašymas 8',
            'kaina' => 100.59,
            'pagrindine_nuotrauka' => 'images/product_8.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 9,
            'pavadinimas' => 'Testinė prekė 9',
            'kategorija' => 3,
            'aprasas' => 'prekės aprašymas 9',
            'kaina' => 420.59,
            'pagrindine_nuotrauka' => 'images/product_9.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 10,
            'pavadinimas' => 'Testinė prekė 10',
            'kategorija' => 4,
            'aprasas' => 'prekės aprašymas 10',
            'kaina' => 80.99,
            'pagrindine_nuotrauka' => 'images/product_10.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 11,
            'pavadinimas' => 'Testinė prekė 11',
            'kategorija' => 5,
            'aprasas' => 'prekės aprašymas 11',
            'kaina' => 81.99,
            'pagrindine_nuotrauka' => 'images/product_1.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);

        DB::table('prekes')->insert([
            'id' => 12,
            'pavadinimas' => 'Testinė prekė 12',
            'kategorija' => 6,
            'aprasas' => 'prekės aprašymas 12',
            'kaina' => 120.99,
            'pagrindine_nuotrauka' => 'images/product_2.png',
            'data_sukurta' => '2020-11-23 13:17:17',
            'data_atnaujinta' => '2020-11-23 13:17:17'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prekes');
    }
}

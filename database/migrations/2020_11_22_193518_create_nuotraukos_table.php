<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuotraukosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuotraukos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('prekes_paslaugos_id');
            $table->integer('nuotraukos_tipas');
            $table->timestamps();
            $table->unsignedBigInteger('statusas');
        });

        // INSERT INTO `images` (`id`, `url`, `item_id`, `created_at`, `updated_at`) VALUES
        // (1, 'images/product_1.png', 1, '2020-11-22 21:12:29', '2020-11-22 21:12:29'),
        // (2, 'images/product_2.png', 2, '2020-11-22 21:12:42', '2020-11-22 21:12:42'),
        // (3, 'images/product_3.png', 3, '2020-11-22 21:12:49', '2020-11-22 21:12:49'),
        // (4, 'images/product_4.png', 4, '2020-11-22 21:12:56', '2020-11-22 21:12:56');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nuotraukos');
    }
}

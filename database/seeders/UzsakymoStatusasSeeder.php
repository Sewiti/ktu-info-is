<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UzsakymoStatusasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uzsakymo_statusas')->insert([
            ['pavadinimas' => 'Neapmokėtas'],
            ['pavadinimas' => 'Apmokėtas']
        ]);
    }
}

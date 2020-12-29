<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZinutesStatusasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zinutes_statusas')->insert([
            ['pavadinimas' => 'Išsiųsta'],
            ['pavadinimas' => 'Perskaityta']
        ]);
    }
}

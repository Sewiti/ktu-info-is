<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statusas')->insert([
            ['pavadinimas' => 'Atšaukta'],
            ['pavadinimas' => 'Ištrinta'],
            ['pavadinimas' => 'Vykdoma'],
            ['pavadinimas' => 'Baigta'],
            ['pavadinimas' => 'Aktyvus'],
            ['pavadinimas' => 'Laisva'],
            ['pavadinimas' => 'Užimta']
        ]);
    }
}

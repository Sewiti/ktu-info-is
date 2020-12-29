<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusasSeeder::class);
        $this->call(UzsakymoStatusasSeeder::class);
        $this->call(VartotojoTipasSeeder::class);
        $this->call(ZinutesStatusasSeeder::class);

        $this->command->info("Apsėklinimas baigtas :)))");
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Modules\Movements\Database\Seeds\MovementTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MovementTypeSeeder::class);
    }
}

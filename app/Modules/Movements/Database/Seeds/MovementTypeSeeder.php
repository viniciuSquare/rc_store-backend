<?php

namespace App\Modules\Movements\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementTypeSeeder extends Seeder
{
    /**
     * Seed database with core movement types
     *
     * @return void
     */
    public function run()
    {
        DB::table('movement_types')->insert([
            [
                'name'      => 'Entrada',
                'operator'  => 1
            ],
            [
                'name'      => 'Saída',
                'operator'  => 0
            ],
            [
                'name'      => 'Ajuste +',
                'operator'  => 1
            ],
            [
                'name'      => 'Ajuste -',
                'operator'  => 0
            ],
        ]);
    }
}

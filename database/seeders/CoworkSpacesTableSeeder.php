<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoworkSpacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cowork_spaces')->insert([
            ['name' => 'Sala A', 'description' => 'Sala principal para trabajos colaborativos.'],
            ['name' => 'Sala B', 'description' => 'Sala de reuniones privada.'],
            ['name' => 'Sala C', 'description' => 'Sala grande para eventos.'],
            ['name' => 'Sala D', 'description' => 'Espacio tranquilo para trabajo individual.'],
        ]);
    }
}

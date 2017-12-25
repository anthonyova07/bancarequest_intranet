<?php

use Illuminate\Database\Seeder;
use App\Incident;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'title' =>  'Primera incidencia',
            'description' => 'solicitud de prueba para mejorar el proyecto de forma eficiente',
            'priority' =>  'B',

            'category_id' => 2,
            'requirement_id' => 1,
            'level_id' => 1,

            'client_id' => 2,
            'support_id' => 3,

        ]);
    }


}

<?php

use Illuminate\Database\Seeder;
use App\Requirement;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requirement::create([
            'name'  => 'Requerimiento A',
            'description'   => 'El requerimiento A consiste en desarrollar un sistema de requerimientos tecnologicos.',
            
        ]);

        Requirement::create([
            'name'  => 'Requerimiento B',
            'description'   => 'El requerimiento B consiste en desarrollar una aplicacion movil.',
            
        ]);

    }
}

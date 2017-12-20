<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name' =>  'Atencion por telefono',
            'requirement_id'    => 1

        ]);

        Level::create([
            'name' =>  'Soporte de usuario',
            'requirement_id'    => 1

        ]);

        Level::create([
            'name' =>  'Mesa de ayuda',
            'requirement_id'    => 2

        ]);

        Level::create([
            'name' =>  'Consulta especializada',
            'requirement_id'    => 2

        ]);
     
    }
}

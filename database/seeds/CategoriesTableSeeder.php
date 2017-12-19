<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  => 'Categoria A1',
            
            
           
        ]);

        Category::create([
            'name'  => 'Categoria A2',
            
          

        ]);

        Category::create([
            'name'  => 'Categoria B1',
            
          
        ]);

        Category::create([
            'name'  => 'Categoria B2',
            
         

        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);

        $this->call(SupportsTableSeeder::class);
        $this->call(RequirementsUserTableSeeder::class);
        $this->call(IncidentsTableSeeder::class);
    }
}

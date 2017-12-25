<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::create([

                'name'  => 'pedro',
                'email'  => 'pedro@bancamerica.com',
                'password'  => bcrypt('123123'),
                'role'  => '0'

        ]);

        //Cliente
        User::create([
            
                'name'  => 'luis',
                'email'  => 'cliente@bancamerica.com',
                'password'  => bcrypt('123123'),
                'role'  => '2'

        ]);
    }
}

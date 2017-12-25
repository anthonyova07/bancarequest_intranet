<?php

use Illuminate\Database\Seeder;
use App\RequirementUser;

class RequirementsUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequirementUser::create([
            'requirement_id' => 1,
            'user_id'   =>  3,
            'level_id'  =>  1
        ]);

        RequirementUser::create([
            'requirement_id' => 1,
            'user_id'   =>  4,
            'level_id'  =>  2
        ]);
    }
}

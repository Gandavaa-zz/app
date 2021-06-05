<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Candidate;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numbersOfUser = 20;
        $user = Candidate::create([
            'firstname' => 'ganaa',
            'lastname' => 'admin',
            'email' => 'super@admin.com',
            'country_code' => 'en',
            'title_id' => 1,
            'group_id' =>1,
            'user_id' =>1,
            'created_at' =>now(),
            'updated_at' =>now()
        ]);

    }
}

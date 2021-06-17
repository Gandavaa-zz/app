<?php

use App\Translation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numofTranslation = 100;
        $faker = Faker::create();

        for($i = 0; $i<$numofTranslation; $i++){
            Translation::create([
                'test_id'=>1,
                'EN' => $faker->sentence,
                'MN' => $faker->sentence
            ]);
        }

    }
}

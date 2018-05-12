<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=2; $i<152; $i++) {
            DB::table('student')->insert([
                'promo_id' => $faker->numberBetween($min = 0, $max = 2),
                'td' => $faker->numberBetween($min = 1, $max = 2),
                'user_id' => $i,
            ]);
        }
    }
}

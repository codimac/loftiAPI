<?php

use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
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
            DB::table('promo')->insert([
                'promo_id' => $faker->numberBetween($min = 1, $max = 3),
                'name' => $faker->numberBetween($min = 2018, $max = 2020),
            ]);
        }
    }
}

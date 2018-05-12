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

        for($i=0; $i<3; $i++) {
            DB::table('promo')->insert([
                'promo_id' => 2018 + $i,
                'year' => $i,
            ]);
        }
    }
}

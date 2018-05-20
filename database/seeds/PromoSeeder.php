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
        $date = getdate();

        for($i=0; $i<3; $i++) {
            DB::table('promo')->insert([
                'year' => $date['year'] + $i,
            ]);
        }
    }
}
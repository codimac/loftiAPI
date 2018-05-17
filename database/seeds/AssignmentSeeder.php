<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('assignment')->insert([
            'name' => "DM",
            'description' => "Rattrape de partiel",
            'coefficient' => $faker->numberBetween($min = 1, $max = 6),
        ]);

        DB::table('assignment')->insert([
            'name' => "Partiel final",
            'description' => "Partiel final",
            'coefficient' => $faker->numberBetween($min = 1, $max = 6),
        ]);

        DB::table('assignment')->insert([
            'name' => "Conception et analyse",
            'description' => "DM de M. Calvet",
            'coefficient' => $faker->numberBetween($min = 1, $max = 6),
        ]);

        DB::table('assignment')->insert([
            'name' => "Devoir partiel",
            'description' => "Test écrit",
            'coefficient' => $faker->numberBetween($min = 1, $max = 6),
        ]);
        
    }
}

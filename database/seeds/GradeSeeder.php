<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        for ($i=0; $i<500; $i++) {
            DB::table('grade')->insert([
                'grade' => $faker->numberBetween($min = 0, $max = 20),
                'coefficient' => $faker->numberBetween($min = 1, $max = 6),
                'subject_id' => $faker->numberBetween($min = 1, $max = 69),
                'student_id' => $faker->numberBetween($min = 1, $max = 150),
                'assignment_id' => $faker->numberBetween($min = 1, $max = 4),
            ]);
        }
    }
}
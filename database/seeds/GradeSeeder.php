<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
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
        
        for ($i=0; $i<150; $i++) {
            $students = Student::all(['student_id']);
            $random_stud = array_rand(json_decode($students, true));

            $subjects = Subject::all(['subject_id']);
            $random_subj = array_rand(json_decode($subjects, true));
            
            DB::table('grade')->insert([
                'grade' => $faker->numberBetween($min = 0, $max = 20),
                //'grade' => rand (0, 20),
                'coefficient' => $faker->numberBetween($min = 1, $max = 6),
                //'coefficient' => rand (1, 6),
                'subject_id' => json_decode($subjects, true)[$random_subj]["subject_id"],
                //'subject_id' => rand (1, 6),
                'student_id' => json_decode($students, true)[$random_stud]["student_id"]
                //'student_id' => rand (1, 6),
            ]);
        }
    }
}
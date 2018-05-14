<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker\Factory::create();
        

        for ($i=0; $i<41; $i++) {
            //$firstname = $faker->firstname;
            //$lastname = $faker->unique()->lastname;

            $students = Student::all(['student_id']);
            $random_stud = array_rand(json_decode($students, true));
            
            DB::table('absence')->insert([
                'student_id' => json_decode($students, true)[$random_stud]["student_id"],
                'beginning' => randomDate(2018-05-14),
                'end' => randomDate(2018-05-19),
                'justified' => rand(0, 1)
            ]);
        }
    }




    function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }




}

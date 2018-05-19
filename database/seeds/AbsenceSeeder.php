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

            // Convert to timetamps
            $min = strtotime('2018-03-01');
            $max = strtotime('2018-05-20');

            // Generate random number using above bounds
            $val1 = date('Y-m-d', rand($min, $max));
            /*$val2 = date('Y-m-d H:i:s', rand($min, $max));

            $datetime1 = new DateTime($val1);
            $datetime2 = new DateTime($val2);
            $interval =date_diff($datetime1, $datetime2);
            $dif =  $interval->format('%R%');

            if($dif == '+'){
                $beg = $val1;
                $end = $val2;
            }else if($dif == '-'){
                $beg = $val2;
                $end = $val1;
            }*/

            $students = Student::all(['student_id']);
            $random_stud = array_rand(json_decode($students, true));
            
            DB::table('absence')->insert([
                'student_id' => json_decode($students, true)[$random_stud]["student_id"],
                //'beginning' => $beg,
                //'end' => $end,
                'date' => $val1,
                'justified' => rand(0, 1)
            ]);
        }
    }




}

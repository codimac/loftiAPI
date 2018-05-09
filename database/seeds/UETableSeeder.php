<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UETableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 9,
            'name' => "Sciences et info",
        ]);

        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 7,
            'name' => "Design et Médias numériques",
        ]);

        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 8,
            'name' => "Arts",
        ]);

        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 6,
            'name' => "Culture et entreprise",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 1",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 2",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 3",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 4",
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

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
            'ue_id' => 1,
            'semester' => 1,
            'ects' => 2,
            'name' => "UE 1",
        ]);

         DB::table('ue')->insert([
            'ue_id' => 2,
            'semester' => 1,
            'ects' => 2,
            'name' => "UE 2",
        ]);

        DB::table('ue')->insert([
            'ue_id' => 3,
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 3",
        ]);

        DB::table('ue')->insert([
            'ue_id' => 4,
            'semester' => 2,
            'ects' => 2,
            'name' => "UE 4",
        ]);
    }
}

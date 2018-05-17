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
        DB::table('assignment')->insert([
            'name' => "DM",
            'description' => "Rattrape de partiel",
        ]);

        DB::table('assignment')->insert([
            'name' => "Partiel final",
            'description' => "Partiel final",
        ]);

        DB::table('assignment')->insert([
            'name' => "Conception et analyse",
            'description' => "DM de M. Calvet",
        ]);

        DB::table('assignment')->insert([
            'name' => "Devoir partiel",
            'description' => "Test écrit",
        ]);
        
    }
}

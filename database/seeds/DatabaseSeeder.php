<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StudentSeeder::class);
        //$this->call(UETableSeeder::class);
        $this->call(UeSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(PromoSeeder::class);
    }
}
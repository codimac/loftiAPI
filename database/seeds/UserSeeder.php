<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        DB::table('user')->insert([
            'lastname' => 'Donard',
            'firstname' => 'Sylvie',
            'username' => 'root',
            'password' => Hash::make('root'),
            'role_id' => 1
        ]);

        DB::table('user')->insert([
            'lastname' => 'Albert',
            'firstname' => 'Henri',
            'username' => 'student',
            'password' => Hash::make('student'),
            'role_id' => 2
        ]);

        for ($i=1; $i<150; $i++) {
            $firstname = $faker->firstname;
            $lastname = $faker->unique()->lastname;
            
            DB::table('user')->insert([
                'lastname' => $lastname,
                'firstname' => $firstname,
                'username' => strtolower(substr($firstname, 0, 1).$lastname),
                'password' => Hash::make('root'),
                'role_id' => 2
            ]);
        }
    }
}

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

        for ($i=0; $i<41; $i++) {
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

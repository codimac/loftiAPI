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

        for($i=0; $i<41; $i++) {
            if(DB::table('user')->input(['role_id']) == 2) {
                DB::table('student')->insert([
                    'promo' => 2020 - $i % 3,
                    'td' => 'TD1',
                    'user_id' => DB::table('user')->input(['user_id'])
                ]);
            }
        }
    }
}

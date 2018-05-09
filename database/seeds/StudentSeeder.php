<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            'promo' => 2019,
            'td' => 'TD1',
            'user_id' => '2',
        ]);

        DB::table('student')->insert([
            'promo' => 2019,
            'td' => 'TD2',
            'user_id' => '3',
        ]);

        DB::table('student')->insert([
            'promo' => 2020,
            'td' => 'TD1',
            'user_id' => '4',
        ]);

        DB::table('student')->insert([
            'promo' => 2020,
            'td' => 'TD1',
            'user_id' => '5',
        ]);

        DB::table('student')->insert([
            'promo' => 2020,
            'td' => 'TD2',
            'user_id' => '6',
        ]);
        
        /*
        $faker = Faker\Factory::create();

        for($i=0; $i<41; $i++) {
            if(DB::table('user')->input('role_id') == 2) {
                DB::table('student')->insert([
                    'promo' => 2020 - $i % 3,
                    'td' => 'TD1',
                    // Problème : le user_id ne s'incrément pas
                    'user_id' => DB::table('user')->input('user_id')
                ]);
            }
        }
        */
    }
}

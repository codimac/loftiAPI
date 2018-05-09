<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('role')->insert([
            'role_id' => 1,
            'label' => 'ADMIN'
        ]);

        DB::table('role')->insert([
            'role_id' => 2,
            'label' => 'STUDENT'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('subject')->insert([
            'name' => "Mathématiques",
            'coefficient' => 1,
            'ue_id' => 1,
        ]);

        DB::table('subject')->insert([
            'name' => "Programmation web",
            'coefficient' => 1,
            'ue_id' => 1,
        ]);

        DB::table('subject')->insert([
            'name' => "Programmation et Algorithmique",
            'coefficient' => 1,
            'ue_id' => 1,
        ]);

        DB::table('subject')->insert([
            'name' => "Culture du design",
            'coefficient' => 1,
            'ue_id' => 2,
        ]);

        DB::table('subject')->insert([
            'name' => "Arts appliqués",
            'coefficient' => 1,
            'ue_id' => 2,
        ]);

        DB::table('subject')->insert([
            'name' => "Esthétique algorithmique",
            'coefficient' => 1,
            'ue_id' => 2,
        ]);

        DB::table('subject')->insert([
            'name' => "Histoire de l'art",
            'coefficient' => 1,
            'ue_id' => 3,
        ]);

        DB::table('subject')->insert([
            'name' => "Technique de l'image",
            'coefficient' => 1,
            'ue_id' => 3,
        ]);

        DB::table('subject')->insert([
            'name' => "Pratique vidéo",
            'coefficient' => 1,
            'ue_id' => 3,
        ]);

        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 2,
            'ue_id' => 4,
        ]);

        DB::table('subject')->insert([
            'name' => "Communication",
            'coefficient' => 1,
            'ue_id' => 4,
        ]);

        DB::table('subject')->insert([
            'name' => "Projet Voltaire",
            'coefficient' => 1,
            'ue_id' => 4,
        ]);
    }
}

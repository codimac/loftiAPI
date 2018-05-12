<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Année 1 - Semestre 1
        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 9,
            'name' => "Sciences et informatique",
        ]);

        DB::table('ue')->insert([
            'semester' => 1,
            'ects' => 7,
            'name' => "Design et médias numériques",
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

        // Année 1 - Semestre 2
        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 9,
            'name' => "Informatique",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 6,
            'name' => "Sciences de l'ingénieur",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 7,
            'name' => "Cinéma et médias numériques",
        ]);

        DB::table('ue')->insert([
            'semester' => 2,
            'ects' => 8,
            'name' => "Culture et entreprise",
        ]);

        // Année 2 - Semestre 3
        DB::table('ue')->insert([
            'semester' => 3,
            'ects' => 7,
            'name' => "Informatique",
        ]);

        DB::table('ue')->insert([
            'semester' => 3,
            'ects' => 5,
            'name' => "Sciences de l'ingénieur",
        ]);

        DB::table('ue')->insert([
            'semester' => 3,
            'ects' => 7,
            'name' => "Cinéma et médias numériques",
        ]);

        DB::table('ue')->insert([
            'semester' => 3,
            'ects' => 8,
            'name' => "Culture et entreprise",
        ]);

        DB::table('ue')->insert([
            'semester' => 3,
            'ects' => 3,
            'name' => "Projet tuteuré",
        ]);

        // Année 2 - Semestre 4
        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 8,
            'name' => "Sciences et informatique",
        ]);

        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 4,
            'name' => "Design",
        ]);

        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 6,
            'name' => "Arts",
        ]);

        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 3,
            'name' => "Culture et entreprise",
        ]);

        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 3,
            'name' => "Projet tuteuré",
        ]);

        DB::table('ue')->insert([
            'semester' => 4,
            'ects' => 6,
            'name' => "Stage",
        ]);

        // Année 3 - Semestre 5
        DB::table('ue')->insert([
            'semester' => 5,
            'ects' => 7,
            'name' => "Projet pré-professionnels",
        ]);

        DB::table('ue')->insert([
            'semester' => 5,
            'ects' => 8,
            'name' => "Ouverture pluridiciplinaire",
        ]);

        DB::table('ue')->insert([
            'semester' => 5,
            'ects' => 8,
            'name' => "Compétences parcours web",
        ]);

        DB::table('ue')->insert([
            'semester' => 5,
            'ects' => 7,
            'name' => "Compétences transverses",
        ]);

        // Année 3 - Semestre 6
        DB::table('ue')->insert([
            'semester' => 6,
            'ects' => 3,
            'name' => "Ouverture",
        ]);

        DB::table('ue')->insert([
            'semester' => 6,
            'ects' => 27,
            'name' => "Stage",
        ]);
    }
}

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
        // Année 1 - Semestre 1 - UE 1
        DB::table('subject')->insert([
            'name' => "Programmation et algorithmique",
            'coefficient' => 1,
            'ue_id' => 1,
        ]);

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

        // Année 1 - Semestre 1 - UE 2
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

        // Année 1 - Semestre 1 - UE 3
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

        // Année 1 - Semestre 1 - UE 4
        DB::table('subject')->insert([
            'name' => "Communication",
            'coefficient' => 1,
            'ue_id' => 4,
        ]);

        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 2,
            'ue_id' => 4,
        ]);

        DB::table('subject')->insert([
            'name' => "Projet Voltaire",
            'coefficient' => 1,
            'ue_id' => 4,
        ]);

        // Année 1 - Semestre 2 - UE 1
        DB::table('subject')->insert([
            'name' => "Programmation et algorithmique",
            'coefficient' => 3,
            'ue_id' => 5,
        ]);

        DB::table('subject')->insert([
            'name' => "Synthèse d'images",
            'coefficient' => 4,
            'ue_id' => 5,
        ]);

        DB::table('subject')->insert([
            'name' => "Programmation web",
            'coefficient' => 2,
            'ue_id' => 5,
        ]);

        // Année 1 - Semestre 2 - UE 2
        DB::table('subject')->insert([
            'name' => "Mathématiques",
            'coefficient' => 1,
            'ue_id' => 6,
        ]);

        DB::table('subject')->insert([
            'name' => "Traitement du signal",
            'coefficient' => 1,
            'ue_id' => 6,
        ]);

        // Année 1 - Semestre 2 - UE 3
        DB::table('subject')->insert([
            'name' => "Culture des nouveaux médias",
            'coefficient' => 1,
            'ue_id' => 7,
        ]);

        DB::table('subject')->insert([
            'name' => "Expression et écriture",
            'coefficient' => 1,
            'ue_id' => 7,
        ]);

        DB::table('subject')->insert([
            'name' => "Post production",
            'coefficient' => 1,
            'ue_id' => 7,
        ]);

        DB::table('subject')->insert([
            'name' => "Traitement du son",
            'coefficient' => 1,
            'ue_id' => 7,
        ]);

        // Année 1 - Semestre 2 - UE 4
        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 2,
            'ue_id' => 8,
        ]);

        DB::table('subject')->insert([
            'name' => "Communication",
            'coefficient' => 1,
            'ue_id' => 8,
        ]);

        DB::table('subject')->insert([
            'name' => "Droit",
            'coefficient' => 1,
            'ue_id' => 8,
        ]);

        DB::table('subject')->insert([
            'name' => "Projet Voltaire",
            'coefficient' => 1,
            'ue_id' => 8,
        ]);

        // Année 2 - Semestre 3 - UE 1
        DB::table('subject')->insert([
            'name' => "Programmation objet",
            'coefficient' => 1,
            'ue_id' => 9,
        ]);

        DB::table('subject')->insert([
            'name' => "Architecture logicielle",
            'coefficient' => 1,
            'ue_id' => 9,
        ]);

        DB::table('subject')->insert([
            'name' => "Synthèse d'images",
            'coefficient' => 1,
            'ue_id' => 9,
        ]);

        // Année 2 - Semestre 3 - UE 2
        DB::table('subject')->insert([
            'name' => "Mathématiques",
            'coefficient' => 1,
            'ue_id' => 10,
        ]);

        DB::table('subject')->insert([
            'name' => "Traitement du signal",
            'coefficient' => 1,
            'ue_id' => 10,
        ]);

        // Année 2 - Semestre 3 - UE 3
        DB::table('subject')->insert([
            'name' => "Cultures des nouveaux médias",
            'coefficient' => 1,
            'ue_id' => 11,
        ]);

        DB::table('subject')->insert([
            'name' => "Création 3D",
            'coefficient' => 1,
            'ue_id' => 11,
        ]);

        DB::table('subject')->insert([
            'name' => "Réalisation vidéo",
            'coefficient' => 1,
            'ue_id' => 11,
        ]);

        // Année 2 - Semestre 3 - UE 4
        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 2,
            'ue_id' => 12,
        ]);

        DB::table('subject')->insert([
            'name' => "Communication",
            'coefficient' => 1,
            'ue_id' => 12,
        ]);

        DB::table('subject')->insert([
            'name' => "Economie",
            'coefficient' => 1,
            'ue_id' => 12,
        ]);

        DB::table('subject')->insert([
            'name' => "Management",
            'coefficient' => 1,
            'ue_id' => 12,
        ]);

        // Année 2 - Semestre 3 - UE 5
        DB::table('subject')->insert([
            'name' => "Projet tuteuré",
            'coefficient' => 1,
            'ue_id' => 13,
        ]);

        // Année 2 - Semestre 4 - UE 1
        DB::table('subject')->insert([
            'name' => "Mathématiques",
            'coefficient' => 1,
            'ue_id' => 14,
        ]);

        DB::table('subject')->insert([
            'name' => "Programmation objet",
            'coefficient' => 1,
            'ue_id' => 14,
        ]);

        DB::table('subject')->insert([
            'name' => "Réseau",
            'coefficient' => 1,
            'ue_id' => 14,
        ]);

        DB::table('subject')->insert([
            'name' => "Physique et signal (physique du son)",
            'coefficient' => 1,
            'ue_id' => 14,
        ]);

        // Année 2 - Semestre 4 - UE 2
        DB::table('subject')->insert([
            'name' => "Web design",
            'coefficient' => 1,
            'ue_id' => 15,
        ]);

        DB::table('subject')->insert([
            'name' => "Programmation web",
            'coefficient' => 1,
            'ue_id' => 15,
        ]);

        // Année 2 - Semestre 4 - UE 3
        DB::table('subject')->insert([
            'name' => "Histoire du cinéma d'animation",
            'coefficient' => 1,
            'ue_id' => 16,
        ]);

        DB::table('subject')->insert([
            'name' => "Analyse de l'image",
            'coefficient' => 1,
            'ue_id' => 16,
        ]);
                DB::table('subject')->insert([
            'name' => "Photographie",
            'coefficient' => 1,
            'ue_id' => 16,
        ]);

        DB::table('subject')->insert([
            'name' => "Langage et compréhension du cinéma",
            'coefficient' => 1,
            'ue_id' => 16,
        ]);

        // Année 2 - Semestre 4 - UE 4
        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 2,
            'ue_id' => 17,
        ]);

        DB::table('subject')->insert([
            'name' => "Communication",
            'coefficient' => 1,
            'ue_id' => 17,
        ]);

        // Année 2 - Semestre 4 - UE 5
        DB::table('subject')->insert([
            'name' => "Projet tuteuré",
            'coefficient' => 1,
            'ue_id' => 18,
        ]);

        // Année 2 - Semestre 4 - UE 6
        DB::table('subject')->insert([
            'name' => "Stage",
            'coefficient' => 1,
            'ue_id' => 19,
        ]);

        // Année 3 - Semestre 5 - UE 1
        DB::table('subject')->insert([
            'name' => "Projet web : design et service innovant",
            'coefficient' => 1,
            'ue_id' => 20,
        ]);

        DB::table('subject')->insert([
            'name' => "Projet 3D : jeux vidéo et installation interactive",
            'coefficient' => 1,
            'ue_id' => 20,
        ]);

        DB::table('subject')->insert([
            'name' => "Projet audio : film nouveau et post production",
            'coefficient' => 1,
            'ue_id' => 20,
        ]);

        // Année 3 - Semestre 5 - UE 2
        DB::table('subject')->insert([
            'name' => "Projet personnel pré-professionnel",
            'coefficient' => 1,
            'ue_id' => 21,
        ]);

        DB::table('subject')->insert([
            'name' => "Culture visuelle",
            'coefficient' => 1,
            'ue_id' => 21,
        ]);

        DB::table('subject')->insert([
            'name' => "Approfondissement scientifique",
            'coefficient' => 1,
            'ue_id' => 21,
        ]);

        // Année 3 - Semestre 5 - UE 3
        DB::table('subject')->insert([
            'name' => "Parcours web : technologie web",
            'coefficient' => 1,
            'ue_id' => 22,
        ]);

        DB::table('subject')->insert([
            'name' => "Parcours web : e-marketing",
            'coefficient' => 1,
            'ue_id' => 22,
        ]);

        DB::table('subject')->insert([
            'name' => "Parcours web : cloud computing",
            'coefficient' => 1,
            'ue_id' => 22,
        ]);

        DB::table('subject')->insert([
            'name' => "Parcours web : architecture ou programmation web",
            'coefficient' => 1,
            'ue_id' => 22,
        ]);

        // Année 3 - Semestre 5 - UE 4
        DB::table('subject')->insert([
            'name' => "Gestion des Relations Humaines",
            'coefficient' => 1,
            'ue_id' => 23,
        ]);

        DB::table('subject')->insert([
            'name' => "Anglais",
            'coefficient' => 1,
            'ue_id' => 23,
        ]);

        DB::table('subject')->insert([
            'name' => "Développement durable et CIP",
            'coefficient' => 1,
            'ue_id' => 23,
        ]);

        DB::table('subject')->insert([
            'name' => "Découverte au choix",
            'coefficient' => 1,
            'ue_id' => 23,
        ]);

        // Année 3 - Semestre 6 - UE 1
        DB::table('subject')->insert([
            'name' => "Ouverture",
            'coefficient' => 1,
            'ue_id' => 18,
        ]);

        // Année 3 - Semestre 6 - UE 2
        DB::table('subject')->insert([
            'name' => "Mémoire",
            'coefficient' => 1,
            'ue_id' => 19,
        ]);
        
        DB::table('subject')->insert([
            'name' => "Soutenance",
            'coefficient' => 1,
            'ue_id' => 19,
        ]);
    }
}
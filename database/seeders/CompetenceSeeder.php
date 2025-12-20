<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('competences')->insert([
            [
                'nom' => 'Taille des arbres',
                'description' => 'Compétence en taille et entretien des arbres fruitiers et ornementaux.',
            ],
            [
                'nom' => 'Entretien des pelouses',
                'description' => 'Expertise dans la tonte, l\'aération et la fertilisation des pelouses.',
            ],
            [
                'nom' => 'Plantation de fleurs',
                'description' => 'Compétence en sélection, plantation et entretien des fleurs saisonnières et vivaces.',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JardinierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jardiniers')->insert([
            'user_id' => 2,
            'profession' => 'Jardinier Expert',
            'description' => 'Jardinier passionné avec 5 ans d\'expérience dans l\'entretien des espaces verts.',
            'disponible' => true,
            'tarif_horaire' => 2000,
            'tarif_journalier' => 15000,
            'site_web' => 'https://jardinier-expert.com',
        ]);

        DB::table('jardiniers')->insert([
            'user_id' => 3,
            'profession' => 'Jardinier Expert',
            'description' => 'Jardinier passionné avec 7 ans d\'expérience dans l\'entretien des espaces verts.',
            'disponible' => true,
            'tarif_horaire' => 1500,
            'tarif_journalier' => 10000,
            'site_web' => 'https://jardinier-hard.com',
        ]);
    }
}

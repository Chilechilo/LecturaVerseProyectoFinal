<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Fantasía',
                'description' => 'Historias con mundos mágicos, criaturas sobrenaturales o poderes especiales.',
            ],
            [
                'name' => 'Shonen',
                'description' => 'Manga orientado a acción, aventura y crecimiento del protagonista.',
            ],
            [
                'name' => 'Seinen',
                'description' => 'Manga con temas más maduros, psicológicos o complejos.',
            ],
            [
                'name' => 'Superhéroes',
                'description' => 'Cómics centrados en héroes, villanos y universos compartidos.',
            ],
            [
                'name' => 'Terror',
                'description' => 'Historias de miedo, suspenso, monstruos o fenómenos inquietantes.',
            ],
            [
                'name' => 'Romance',
                'description' => 'Historias centradas en relaciones amorosas y conflictos emocionales.',
            ],
            [
                'name' => 'Ciencia ficción',
                'description' => 'Relatos con tecnología avanzada, futuros alternativos o viajes espaciales.',
            ],
            [
                'name' => 'Aventura',
                'description' => 'Historias de viajes, exploración, misiones o descubrimientos.',
            ],
            [
                'name' => 'Drama',
                'description' => 'Narrativas con conflictos personales, familiares o sociales.',
            ],
            [
                'name' => 'Comedia',
                'description' => 'Historias con enfoque humorístico o situaciones divertidas.',
            ],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
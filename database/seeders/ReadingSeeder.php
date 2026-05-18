<?php

namespace Database\Seeders;

use App\Models\Reading;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class ReadingSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@test.com')->first();
        $luis = User::where('email', 'luis@test.com')->first();
        $ana = User::where('email', 'ana@test.com')->first();

        $fantasia = Genre::where('name', 'Fantasía')->first();
        $shonen = Genre::where('name', 'Shonen')->first();
        $seinen = Genre::where('name', 'Seinen')->first();
        $superheroes = Genre::where('name', 'Superhéroes')->first();
        $terror = Genre::where('name', 'Terror')->first();
        $romance = Genre::where('name', 'Romance')->first();
        $cienciaFiccion = Genre::where('name', 'Ciencia ficción')->first();
        $aventura = Genre::where('name', 'Aventura')->first();
        $drama = Genre::where('name', 'Drama')->first();
        $comedia = Genre::where('name', 'Comedia')->first();

        $readings = [
            [
                'user_id' => $admin->id,
                'genre_id' => $fantasia->id,
                'title' => 'El Hobbit',
                'author' => 'J. R. R. Tolkien',
                'type' => 'libro',
                'status' => 'terminado',
                'total_units' => 310,
                'current_unit' => 310,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Novela de fantasía sobre la aventura de Bilbo Bolsón.',
            ],
            [
                'user_id' => $luis->id,
                'genre_id' => $shonen->id,
                'title' => 'One Piece',
                'author' => 'Eiichiro Oda',
                'type' => 'manga',
                'status' => 'leyendo',
                'total_units' => 1100,
                'current_unit' => 450,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Manga de aventuras sobre piratas y sueños.',
            ],
            [
                'user_id' => $ana->id,
                'genre_id' => $seinen->id,
                'title' => 'Berserk',
                'author' => 'Kentaro Miura',
                'type' => 'manga',
                'status' => 'leyendo',
                'total_units' => 364,
                'current_unit' => 120,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Manga oscuro de fantasía, tragedia y supervivencia.',
            ],
            [
                'user_id' => $admin->id,
                'genre_id' => $superheroes->id,
                'title' => 'Batman: Year One',
                'author' => 'Frank Miller',
                'type' => 'comic',
                'status' => 'terminado',
                'total_units' => 4,
                'current_unit' => 4,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Cómic clásico sobre el origen moderno de Batman.',
            ],
            [
                'user_id' => $luis->id,
                'genre_id' => $terror->id,
                'title' => 'Uzumaki',
                'author' => 'Junji Ito',
                'type' => 'manga',
                'status' => 'pendiente',
                'total_units' => 20,
                'current_unit' => 0,
                'rating' => null,
                'cover_url' => null,
                'description' => 'Manga de terror centrado en una maldición relacionada con espirales.',
            ],
            [
                'user_id' => $ana->id,
                'genre_id' => $romance->id,
                'title' => 'Your Name',
                'author' => 'Makoto Shinkai',
                'type' => 'manga',
                'status' => 'terminado',
                'total_units' => 9,
                'current_unit' => 9,
                'rating' => 4,
                'cover_url' => null,
                'description' => 'Historia romántica con elementos sobrenaturales.',
            ],
            [
                'user_id' => $admin->id,
                'genre_id' => $cienciaFiccion->id,
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'type' => 'libro',
                'status' => 'leyendo',
                'total_units' => 688,
                'current_unit' => 200,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Novela de ciencia ficción política, ecológica y espacial.',
            ],
            [
                'user_id' => $luis->id,
                'genre_id' => $aventura->id,
                'title' => 'Tintín en el Tíbet',
                'author' => 'Hergé',
                'type' => 'comic',
                'status' => 'pausado',
                'total_units' => 62,
                'current_unit' => 30,
                'rating' => 4,
                'cover_url' => null,
                'description' => 'Cómic de aventura sobre la búsqueda de un amigo perdido.',
            ],
            [
                'user_id' => $ana->id,
                'genre_id' => $drama->id,
                'title' => 'A Silent Voice',
                'author' => 'Yoshitoki Ōima',
                'type' => 'manga',
                'status' => 'terminado',
                'total_units' => 62,
                'current_unit' => 62,
                'rating' => 5,
                'cover_url' => null,
                'description' => 'Manga dramático sobre culpa, bullying y redención.',
            ],
            [
                'user_id' => $admin->id,
                'genre_id' => $comedia->id,
                'title' => 'Scott Pilgrim',
                'author' => 'Bryan Lee O’Malley',
                'type' => 'comic',
                'status' => 'leyendo',
                'total_units' => 6,
                'current_unit' => 2,
                'rating' => 4,
                'cover_url' => null,
                'description' => 'Cómic de comedia, romance y peleas estilo videojuego.',
            ],
        ];

        foreach ($readings as $reading) {
            Reading::create($reading);
        }
    }
}
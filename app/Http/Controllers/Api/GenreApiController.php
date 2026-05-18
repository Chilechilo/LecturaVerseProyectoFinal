<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreApiController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('readings')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Lista de géneros obtenida correctamente.',
            'data' => $genres,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Género creado correctamente.',
            'data' => $genre,
        ], 201);
    }

    public function show(Genre $genre)
    {
        $genre->load('readings');

        return response()->json([
            'success' => true,
            'message' => 'Género encontrado correctamente.',
            'data' => $genre,
        ]);
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:genres,name,' . $genre->id,
            'description' => 'nullable|string',
        ]);

        $genre->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Género actualizado correctamente.',
            'data' => $genre,
        ]);
    }

    public function destroy(Genre $genre)
    {
        if ($genre->readings()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar este género porque tiene lecturas relacionadas.',
            ], 409);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Género eliminado correctamente.',
        ]);
    }
}
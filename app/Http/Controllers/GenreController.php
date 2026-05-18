<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $genres = Genre::withCount('readings')
            ->orderBy('name')
            ->get();

        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('genres.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
            'description' => 'nullable|string',
        ]);

        Genre::create($validated);

        return redirect()
            ->route('genres.index')
            ->with('success', 'Género creado correctamente.');
    }

    public function show(Genre $genre)
    {
        $this->authorizeAdmin();

        $genre->load('readings');

        return view('genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        $this->authorizeAdmin();

        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
            'description' => 'nullable|string',
        ]);

        $genre->update($validated);

        return redirect()
            ->route('genres.index')
            ->with('success', 'Género actualizado correctamente.');
    }

    public function destroy(Genre $genre)
    {
        $this->authorizeAdmin();

        if ($genre->readings()->count() > 0) {
            return redirect()
                ->route('genres.index')
                ->with('error', 'No puedes eliminar este género porque tiene lecturas relacionadas.');
        }

        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with('success', 'Género eliminado correctamente.');
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Solo el administrador puede acceder a esta sección.');
        }
    }
}
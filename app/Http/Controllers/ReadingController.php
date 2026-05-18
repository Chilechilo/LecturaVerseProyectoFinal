<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $readings = Reading::with(['user', 'genre'])
                ->latest()
                ->get();
        } else {
            $readings = Reading::with('genre')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('readings.index', compact('readings'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('readings.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'required|in:libro,comic,manga',
            'status' => 'required|in:pendiente,leyendo,terminado,pausado,abandonado',
            'total_units' => 'required|integer|min:1',
            'current_unit' => 'required|integer|min:0',
            'rating' => 'nullable|integer|min:1|max:5',
            'cover_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        if ($validated['current_unit'] > $validated['total_units']) {
            return back()
                ->withErrors(['current_unit' => 'El progreso actual no puede ser mayor que el total.'])
                ->withInput();
        }

        $validated['user_id'] = Auth::id();

        Reading::create($validated);

        return redirect()
            ->route('readings.index')
            ->with('success', 'Lectura registrada correctamente.');
    }

    public function show(Reading $reading)
    {
        $this->authorizeReading($reading);

        $reading->load(['user', 'genre']);

        return view('readings.show', compact('reading'));
    }

    public function edit(Reading $reading)
    {
        $this->authorizeReading($reading);

        $genres = Genre::orderBy('name')->get();

        return view('readings.edit', compact('reading', 'genres'));
    }

    public function update(Request $request, Reading $reading)
{
    $this->authorizeReading($reading);

    $validated = $request->validate([
        'genre_id' => 'required|exists:genres,id',
        'title' => 'required|string|max:255',
        'author' => 'nullable|string|max:255',
        'type' => 'required|in:libro,comic,manga',
        'status' => 'required|in:pendiente,leyendo,terminado,pausado,abandonado',
        'total_units' => 'required|integer|min:1',
        'current_unit' => 'required|integer|min:0',
        'rating' => 'nullable|integer|min:1|max:5',
        'cover_url' => 'nullable|string|max:500',
        'description' => 'nullable|string',
    ]);

    if ($validated['current_unit'] > $validated['total_units']) {
        return back()
            ->withErrors(['current_unit' => 'El progreso actual no puede ser mayor que el total.'])
            ->withInput();
    }

    $reading->update($validated);

    return redirect()
        ->route('readings.index')
        ->with('success', 'Lectura actualizada correctamente.');
}

    public function destroy(Reading $reading)
    {
        $this->authorizeReading($reading);

        $reading->delete();

        return redirect()
            ->route('readings.index')
            ->with('success', 'Lectura eliminada correctamente.');
    }

    private function authorizeReading(Reading $reading)
    {
        if (Auth::user()->role !== 'admin' && $reading->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a esta lectura.');
        }
    }
}
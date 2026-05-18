<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reading;
use Illuminate\Http\Request;

class ReadingApiController extends Controller
{
    public function index()
    {
        $readings = Reading::with(['user', 'genre'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Lista de lecturas obtenida correctamente.',
            'data' => $readings,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
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
            return response()->json([
                'success' => false,
                'message' => 'El progreso actual no puede ser mayor que el total.',
            ], 422);
        }

        $reading = Reading::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lectura creada correctamente.',
            'data' => $reading,
        ], 201);
    }

    public function show(Reading $reading)
    {
        $reading->load(['user', 'genre']);

        return response()->json([
            'success' => true,
            'message' => 'Lectura encontrada correctamente.',
            'data' => $reading,
        ]);
    }

    public function update(Request $request, Reading $reading)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'genre_id' => 'sometimes|exists:genres,id',
            'title' => 'sometimes|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'sometimes|in:libro,comic,manga',
            'status' => 'sometimes|in:pendiente,leyendo,terminado,pausado,abandonado',
            'total_units' => 'sometimes|integer|min:1',
            'current_unit' => 'sometimes|integer|min:0',
            'rating' => 'nullable|integer|min:1|max:5',
            'cover_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        $totalUnits = $validated['total_units'] ?? $reading->total_units;
        $currentUnit = $validated['current_unit'] ?? $reading->current_unit;

        if ($currentUnit > $totalUnits) {
            return response()->json([
                'success' => false,
                'message' => 'El progreso actual no puede ser mayor que el total.',
            ], 422);
        }

        $reading->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lectura actualizada correctamente.',
            'data' => $reading,
        ]);
    }

    public function destroy(Reading $reading)
    {
        $reading->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lectura eliminada correctamente.',
        ]);
    }
}
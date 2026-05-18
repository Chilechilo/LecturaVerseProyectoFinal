<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalle de lectura
            </h2>

            <a href="{{ route('readings.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        @if($reading->cover_url)
                            <img src="{{ $reading->cover_url }}"
                                 alt="Portada de {{ $reading->title }}"
                                 class="w-full rounded shadow">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                                Sin portada
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            {{ $reading->title }}
                        </h3>

                        <div class="space-y-3 text-gray-700">
                            <p>
                                <strong>Autor:</strong>
                                {{ $reading->author ?? 'No especificado' }}
                            </p>

                            <p>
                                <strong>Tipo:</strong>
                                <span class="capitalize">{{ $reading->type }}</span>
                            </p>

                            <p>
                                <strong>Género:</strong>
                                {{ $reading->genre->name ?? 'Sin género' }}
                            </p>

                            <p>
                                <strong>Estado:</strong>
                                <span class="capitalize">{{ $reading->status }}</span>
                            </p>

                            <p>
                                <strong>Progreso:</strong>
                                {{ $reading->current_unit }} / {{ $reading->total_units }}
                            </p>

                            <p>
                                <strong>Calificación:</strong>
                                @if($reading->rating)
                                    {{ $reading->rating }} / 5
                                @else
                                    Sin calificación
                                @endif
                            </p>

                            @if(auth()->user()->role === 'admin')
                                <p>
                                    <strong>Usuario:</strong>
                                    {{ $reading->user->name ?? 'Sin usuario' }}
                                </p>
                            @endif

                            <p>
                                <strong>Fecha de registro:</strong>
                                {{ $reading->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="mt-6">
                            <h4 class="font-semibold text-gray-800 mb-2">
                                Descripción / Notas
                            </h4>

                            <p class="text-gray-700 bg-gray-50 p-4 rounded">
                                {{ $reading->description ?? 'Sin descripción o notas.' }}
                            </p>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('readings.edit', $reading) }}"
                               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Editar
                            </a>

                            <form action="{{ route('readings.destroy', $reading) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Seguro que quieres eliminar esta lectura?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
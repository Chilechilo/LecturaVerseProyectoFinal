<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalle del género
            </h2>

            <a href="{{ route('genres.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    {{ $genre->name }}
                </h3>

                <p class="text-gray-700 mb-6">
                    {{ $genre->description ?? 'Sin descripción.' }}
                </p>

                <h4 class="font-semibold text-gray-800 mb-3">
                    Lecturas relacionadas
                </h4>

                @if($genre->readings->count() > 0)
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach($genre->readings as $reading)
                            <li>
                                {{ $reading->title }}
                                <span class="text-gray-500">
                                    — {{ ucfirst($reading->type) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">
                        Este género todavía no tiene lecturas relacionadas.
                    </p>
                @endif

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('genres.edit', $genre) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Editar
                    </a>

                    <form action="{{ route('genres.destroy', $genre) }}"
                          method="POST"
                          onsubmit="return confirm('¿Seguro que quieres eliminar este género?')">
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
</x-app-layout>
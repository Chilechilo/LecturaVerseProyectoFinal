<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de géneros
            </h2>

            <a href="{{ route('genres.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Nuevo género
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($genres->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Nombre</th>
                                    <th class="border px-4 py-2 text-left">Descripción</th>
                                    <th class="border px-4 py-2 text-left">Lecturas relacionadas</th>
                                    <th class="border px-4 py-2 text-left">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($genres as $genre)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            {{ $genre->name }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $genre->description ?? 'Sin descripción' }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $genre->readings_count }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            <div class="flex gap-2">
                                                <a href="{{ route('genres.show', $genre) }}"
                                                   class="text-blue-600 hover:underline">
                                                    Ver
                                                </a>

                                                <a href="{{ route('genres.edit', $genre) }}"
                                                   class="text-yellow-600 hover:underline">
                                                    Editar
                                                </a>

                                                <form action="{{ route('genres.destroy', $genre) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('¿Seguro que quieres eliminar este género?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="text-red-600 hover:underline">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">
                        Todavía no hay géneros registrados.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
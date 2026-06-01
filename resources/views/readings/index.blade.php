<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestor de lecturas
            </h2>

            <div class="flex gap-2">
               <a href="{{ route('readings.report') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Imprimir reporte
                </a>

                <a href="{{ route('readings.create') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Nueva lectura
                </a>
            </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($readings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Título</th>
                                    <th class="border px-4 py-2 text-left">Tipo</th>
                                    <th class="border px-4 py-2 text-left">Género</th>
                                    <th class="border px-4 py-2 text-left">Estado</th>
                                    <th class="border px-4 py-2 text-left">Progreso</th>
                                    @if(auth()->user()->role === 'admin')
                                        <th class="border px-4 py-2 text-left">Usuario</th>
                                    @endif
                                    <th class="border px-4 py-2 text-left">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($readings as $reading)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            {{ $reading->title }}
                                        </td>

                                        <td class="border px-4 py-2 capitalize">
                                            {{ $reading->type }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $reading->genre->name ?? 'Sin género' }}
                                        </td>

                                        <td class="border px-4 py-2 capitalize">
                                            {{ $reading->status }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $reading->current_unit }} / {{ $reading->total_units }}
                                        </td>

                                        @if(auth()->user()->role === 'admin')
                                            <td class="border px-4 py-2">
                                                {{ $reading->user->name ?? 'Sin usuario' }}
                                            </td>
                                        @endif

                                        <td class="border px-4 py-2">
                                            <div class="flex gap-2">
                                                <a href="{{ route('readings.show', $reading) }}"
                                                   class="text-blue-600 hover:underline">
                                                    Ver
                                                </a>

                                                <a href="{{ route('readings.edit', $reading) }}"
                                                   class="text-yellow-600 hover:underline">
                                                    Editar
                                                </a>

                                                <form action="{{ route('readings.destroy', $reading) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('¿Seguro que quieres eliminar esta lectura?')">
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
                        Todavía no tienes lecturas registradas.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
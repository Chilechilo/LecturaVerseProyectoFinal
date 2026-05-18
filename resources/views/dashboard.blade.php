<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel principal
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    Bienvenido, {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-600 mt-2">
                    Este es tu gestor de lecturas para administrar libros, cómics y manga.
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Rol actual:
                    <span class="font-semibold uppercase">
                        {{ auth()->user()->role }}
                    </span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">
                        Mis lecturas
                    </h4>

                    <p class="text-gray-600 mb-4">
                        Registra tus libros, cómics y manga. Puedes guardar progreso, estado, calificación y notas.
                    </p>

                    <a href="{{ route('readings.index') }}"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Ir a lecturas
                    </a>
                </div>

                @if(auth()->user()->role === 'admin')
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h4 class="text-xl font-semibold text-gray-800 mb-2">
                            Gestión de géneros
                        </h4>

                        <p class="text-gray-600 mb-4">
                            Administra los géneros disponibles para clasificar las lecturas del sistema.
                        </p>

                        <a href="{{ route('genres.index') }}"
                           class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                            Ir a géneros
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
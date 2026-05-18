<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar género
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Hay errores en el formulario:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('genres.update', $genre) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nombre del género</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $genre->name) }}"
                               class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Descripción</label>
                        <textarea name="description"
                                  class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                  rows="4">{{ old('description', $genre->description) }}</textarea>
                    </div>

                    <div class="flex justify-between mt-8 border-t pt-6">
                        <a href="{{ route('genres.index') }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 font-semibold">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
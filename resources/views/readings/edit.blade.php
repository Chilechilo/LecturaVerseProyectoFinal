<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar lectura
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

                <form action="{{ route('readings.update', $reading) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Título</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $reading->title) }}"
                               class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Autor</label>
                        <input type="text"
                               name="author"
                               value="{{ old('author', $reading->author) }}"
                               class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Género</label>
                        <select name="genre_id"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                required>
                            <option value="">Selecciona un género</option>

                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    @selected(old('genre_id', $reading->genre_id) == $genre->id)>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Tipo</label>
                        <select name="type"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                required>
                            <option value="libro" @selected(old('type', $reading->type) == 'libro')>
                                Libro
                            </option>

                            <option value="comic" @selected(old('type', $reading->type) == 'comic')>
                                Cómic
                            </option>

                            <option value="manga" @selected(old('type', $reading->type) == 'manga')>
                                Manga
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Estado</label>
                        <select name="status"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                required>
                            <option value="pendiente" @selected(old('status', $reading->status) == 'pendiente')>
                                Pendiente
                            </option>

                            <option value="leyendo" @selected(old('status', $reading->status) == 'leyendo')>
                                Leyendo
                            </option>

                            <option value="terminado" @selected(old('status', $reading->status) == 'terminado')>
                                Terminado
                            </option>

                            <option value="pausado" @selected(old('status', $reading->status) == 'pausado')>
                                Pausado
                            </option>

                            <option value="abandonado" @selected(old('status', $reading->status) == 'abandonado')>
                                Abandonado
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Total de páginas/capítulos
                            </label>

                            <input type="number"
                                   name="total_units"
                                   value="{{ old('total_units', $reading->total_units) }}"
                                   class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                   min="1"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Progreso actual
                            </label>

                            <input type="number"
                                   name="current_unit"
                                   value="{{ old('current_unit', $reading->current_unit) }}"
                                   class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                   min="0"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Calificación 1-5</label>

                        <input type="number"
                               name="rating"
                               value="{{ old('rating', $reading->rating) }}"
                               class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                               min="1"
                               max="5">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">URL de portada</label>

                        <input type="text"
                               name="cover_url"
                               value="{{ old('cover_url', $reading->cover_url) }}"
                               class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Descripción o notas</label>

                        <textarea name="description"
                                  class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                  rows="4">{{ old('description', $reading->description) }}</textarea>
                    </div>

                    <div class="flex justify-between items-center mt-8 border-t pt-6">
                        <a href="{{ route('readings.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 border border-indigo-700 font-semibold">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
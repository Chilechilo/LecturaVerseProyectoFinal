<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Lecturas - LecturaVerse</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #1f2937;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #3730a3;
        }

        .header p {
            margin: 5px 0;
            color: #4b5563;
        }

        .filters {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .filters form {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        label {
            font-weight: bold;
            font-size: 13px;
        }

        select,
        input {
            width: 100%;
            padding: 7px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            margin-top: 4px;
        }

        .actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 9px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-primary {
            background: #4f46e5;
        }

        .btn-secondary {
            background: #6b7280;
        }

        .btn-success {
            background: #059669;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }

        th {
            background: #3730a3;
            color: white;
            padding: 9px;
            border: 1px solid #d1d5db;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #d1d5db;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        .summary {
            margin-top: 15px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #6b7280;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 15px;
            }

            table {
                font-size: 11px;
            }

            th {
                background: #e5e7eb !important;
                color: black !important;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>LecturaVerse</h1>
        <p>Reporte de lecturas registradas</p>
        <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>
        <p>Usuario: {{ auth()->user()->name }} | Rol: {{ auth()->user()->role }}</p>
    </div>

    <div class="filters no-print">
        <form method="GET" action="{{ route('readings.report') }}">
            <div>
                <label for="genre_id">Género</label>
                <select name="genre_id" id="genre_id">
                    <option value="">Todos</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(request('genre_id') == $genre->id)>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type">Tipo</label>
                <select name="type" id="type">
                    <option value="">Todos</option>
                    <option value="libro" @selected(request('type') == 'libro')>Libro</option>
                    <option value="comic" @selected(request('type') == 'comic')>Cómic</option>
                    <option value="manga" @selected(request('type') == 'manga')>Manga</option>
                </select>
            </div>

            <div>
                <label for="status">Estado</label>
                <select name="status" id="status">
                    <option value="">Todos</option>
                    <option value="pendiente" @selected(request('status') == 'pendiente')>Pendiente</option>
                    <option value="leyendo" @selected(request('status') == 'leyendo')>Leyendo</option>
                    <option value="terminado" @selected(request('status') == 'terminado')>Terminado</option>
                    <option value="pausado" @selected(request('status') == 'pausado')>Pausado</option>
                    <option value="abandonado" @selected(request('status') == 'abandonado')>Abandonado</option>
                </select>
            </div>

            <div>
                <label for="date_from">Desde</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}">
            </div>

            <div>
                <label for="date_to">Hasta</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}">
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">
                    Aplicar filtros
                </button>

                <a href="{{ route('readings.report') }}" class="btn btn-secondary">
                    Limpiar
                </a>

                <button type="button" onclick="window.print()" class="btn btn-success">
                    Imprimir Reporte / Guardar PDF
                </button>
            </div>
        </form>
    </div>

    <div class="summary">
        Total de registros encontrados: {{ $readings->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Tipo</th>
                <th>Género</th>
                <th>Estado</th>
                <th>Progreso</th>
                <th>Calificación</th>
                @if(auth()->user()->role === 'admin')
                    <th>Usuario</th>
                @endif
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @forelse($readings as $reading)
                <tr>
                    <td>{{ $reading->title }}</td>
                    <td>{{ $reading->author ?? 'No especificado' }}</td>
                    <td>{{ ucfirst($reading->type) }}</td>
                    <td>{{ $reading->genre->name ?? 'Sin género' }}</td>
                    <td>{{ ucfirst($reading->status) }}</td>
                    <td>{{ $reading->current_unit }} / {{ $reading->total_units }}</td>
                    <td>
                        @if($reading->rating)
                            {{ $reading->rating }} / 5
                        @else
                            Sin calificación
                        @endif
                    </td>

                    @if(auth()->user()->role === 'admin')
                        <td>{{ $reading->user->name ?? 'Sin usuario' }}</td>
                    @endif

                    <td>{{ $reading->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->role === 'admin' ? 9 : 8 }}">
                        No se encontraron lecturas con los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Reporte generado desde LecturaVerse - Gestor de lecturas de libros, cómics y manga.
    </div>

    <div class="no-print" style="margin-top: 25px;">
        <a href="{{ route('readings.index') }}" class="btn btn-secondary">
            Volver a lecturas
        </a>
    </div>

</body>
</html>
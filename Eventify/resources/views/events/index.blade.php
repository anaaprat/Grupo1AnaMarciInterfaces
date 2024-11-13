<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos existentes */
        body {
            background: #4B3C80;
            color: white;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            position: relative;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        /* Botón de Logout */
        .btn-logout {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        /* Estilos del menú principal */
        .menu {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #6f5f9d;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1000;
        }
        .menu-item {
            position: relative;
            cursor: default;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .menu-item:hover {
            background-color: #5a4a78;
        }
        .dropdown {
            display: none;
            position: absolute;
            background-color: #8b7da7;
            border-radius: 5px;
            z-index: 1000;
            padding: 10px;
            margin-top: -10px;
            width: 150px;
            left: 50%;
            transform: translateX(-50%);
            bottom: 100%;
        }
        .menu-item:hover .dropdown {
            display: block;
        }
        .category,
        .clear-filters {
            padding: 5px 10px;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 3px;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        .category:hover,
        .clear-filters:hover {
            background-color: #7c6e9a;
        }
        .category i,
        .clear-filters i {
            margin-right: 8px;
        }
        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #8b5cf6;
            border-radius: 10px;
            overflow: hidden;
        }
        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            vertical-align: middle;
        }
        th {
            background-color: #9e7fe6;
            color: white;
        }
        td {
            color: white;
        }
        /* Alineación y diseño de los botones de "Manage" */
        .manage-buttons {
            display: flex;
            justify-content: center; /* Centra los botones dentro de la celda */
            align-items: center; /* Alineación vertical */
            gap: 10px; /* Espaciado entre botones */
        }
        .manage-buttons button {
            border: none;
            background-color: transparent;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .manage-buttons button:hover {
            background-color: #7c6e9a;
        }
        .manage-buttons i {
            font-size: 18px;
            color: white;
        }
        .btn-add {
            background-color: #2ecc71;
            border: none;
            color: white;
            padding: 15px 20px;
            border-radius: 50%;
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 24px;
            transition: background-color 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-add:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <button class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
    </button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <h1>Manage Events</h1>
    <div class="menu">
        <div class="menu-item">
            Events
            <div class="dropdown">
                <!-- Filtrado basado en el ID de categoría -->
                <div class="category" onclick="filterEvents(1)">
                    <i class="fas fa-music"></i> Music
                </div>
                <div class="category" onclick="filterEvents(2)">
                    <i class="fas fa-futbol"></i> Sport
                </div>
                <div class="category" onclick="filterEvents(3)">
                    <i class="fas fa-laptop"></i> Technology
                </div>
                <div class="clear-filters" onclick="clearFilters()">
                    <i class="fas fa-times-circle"></i> Clear Filters
                </div>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Organized ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Location</th>
                <th>Max Attendees</th>
                <th>Price</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody id="event-table">
            @foreach ($events as $event)
                @if($event->deleted == 0)
                <tr class="event-row" data-category-id="{{ $event->category_id }}">
                    <td>{{ $event->organized_id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->start_time }}</td>
                    <td>{{ $event->end_time }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->max_attendees }}</td>
                    <td>{{ $event->price }}</td>
                    <td class="manage-buttons">
                        <!-- Botón de visualizar evento -->
                        <a href="{{ route('events.show', $event->id) }}" title="View">
                            <button>
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <!-- Botón de editar evento -->
                        <a href="{{ route('events.edit', $event->id) }}" title="Edit">
                            <button>
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>
                        <!-- Botón de eliminar evento -->
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('events.create') }}" class="btn-add">
        <i class="fas fa-plus"></i>
    </a>
    <script>
        function filterEvents(categoryId) {
            const rows = document.querySelectorAll('.event-row');
            rows.forEach(row => {
                row.style.display = row.getAttribute('data-category-id') == categoryId ? '' : 'none';
            });
        }
        function clearFilters() {
            const rows = document.querySelectorAll('.event-row');
            rows.forEach(row => row.style.display = '');
        }
    </script>
</body>
</html>

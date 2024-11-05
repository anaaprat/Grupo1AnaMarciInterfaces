<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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

        /* Estilos del menú principal */
        .menu {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #6f5f9d; /* Fondo del menú */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1000;
        }

        .menu-item {
            position: relative;
            cursor: default; /* Indica que no es clicable */
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .menu-item:hover {
            background-color: #5a4a78; /* Cambia el fondo al pasar el mouse */
        }

        .dropdown {
            display: none; /* Inicialmente oculto */
            position: absolute;
            background-color: #8b7da7; /* Fondo del submenú */
            border-radius: 5px;
            z-index: 1000; /* Asegura que el menú esté encima */
            padding: 10px;
            margin-top: -10px; /* Mueve el submenú hacia arriba */
            width: 150px;
            left: 50%;
            transform: translateX(-50%);
            bottom: 100%; /* Ubica el submenú justo encima del menú */
        }

        .menu-item:hover .dropdown {
            display: block; /* Muestra el submenú al pasar el ratón */
        }

        .category {
            padding: 5px 10px;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 3px; /* Redondear las esquinas de las categorías */
            transition: background-color 0.2s;
        }

        .category:hover {
            background-color: #7c6e9a; /* Color de fondo al pasar el mouse sobre la categoría */
        }

        .category i {
            margin-right: 8px; /* Espacio entre el ícono y el texto */
        }

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
        }

        th {
            background-color: #9e7fe6;
            color: white;
        }

        td {
            color: white;
        }

        .manage-buttons {
            display: flex; /* Cambiado a flex para alinear los botones */
            gap: 10px; /* Espaciado entre los botones */
        }

        .manage-buttons button {
            border: none;
            background-color: transparent;
            cursor: default; /* Cambiado a default para indicar que no son clicables */
        }

        .manage-buttons i {
            font-size: 18px;
            margin-right: 10px;
            color: white; /* Color de los iconos */
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
            cursor: default; /* Cambiado a default para indicar que no es clicable */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para el botón */
        }

        .btn-add:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <h1>Manage Events</h1>

    <div class="menu">
        <div class="menu-item">
            Eventos
            <div class="dropdown">
                <div class="category">
                    <i class="fas fa-music"></i> Music
                </div>
                <div class="category">
                    <i class="fas fa-futbol"></i> Sport
                </div>
                <div class="category">
                    <i class="fas fa-laptop"></i> Technology
                </div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Organized ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category ID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Location</th>
                <th>Max Attendees</th>
                <th>Price</th>
                <th>Image URL</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->organized_id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->category_id }}</td>
                    <td>{{ $event->start_time }}</td>
                    <td>{{ $event->end_time }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->max_attendees }}</td>
                    <td>{{ $event->price }}</td>
                    <td>{{ $event->image_url }}</td>
                    <td>{{ $event->created_at }}</td>
                    <td>{{ $event->updated_at }}</td>
                    <td class="manage-buttons">
                        <button>
                            <i class="fas fa-eye"></i>
                        </button>
                        <button>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button>
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn-add">
        <i class="fas fa-plus"></i>
    </button>

    <script>
        // Eliminar la función de filtrado, ya que no se necesita
    </script>
</body>

</html>

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

        .category {
            padding: 5px 10px;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 3px;
            transition: background-color 0.2s;
        }

        .category:hover {
            background-color: #7c6e9a;
        }

        .category i {
            margin-right: 8px;
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
            display: flex;
            gap: 10px;
        }

        .manage-buttons button {
            border: none;
            background-color: transparent;
            cursor: pointer;
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
    <!-- Botón de Logout en la esquina superior izquierda -->
    <button class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
    </button>

    <!-- Formulario de logout oculto -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
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
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->organized_id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->start_time }}</td>
                    <td>{{ $event->end_time }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->max_attendees }}</td>
                    <td>{{ $event->price }}</td>
                    <td class="manage-buttons">
                        <button title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button title="Delete">
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
</body>

</html>
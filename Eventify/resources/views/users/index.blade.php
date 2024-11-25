<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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

        .manage-buttons button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .manage-buttons i {
            font-size: 18px;
            margin-right: 10px;
            color: white;
        }

        .btn-danger {
            background-color: #e63946;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .btn-danger:hover {
            background-color: #d62839;
        }

        .btn-activate {
            background-color: #27ae60;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
            border: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .btn-activate:hover {
            background-color: #218c54;
        }

        .btn-deactivate {
            background-color: #e74c3c;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
            border: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .btn-deactivate:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <h1>Manage Users</h1>

    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>REGISTER DATE</th>
                <th>ROLE</th>
                <th>VERIFIED</th>
                <th>ACTIVATED</th>
                <th>DELETED</th>
                <th>MANAGE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email_confirmed ? '1' : '0' }}</td>
                    <td>{{ $user->actived ? '1' : '0' }}</td>
                    <td>{{ $user->deleted ? '1' : '0' }}</td>
                    <td class="manage-buttons">
                        <!-- View Button -->
                        <button onclick="window.location.href='{{ route('users.show', $user->id) }}'">
                            <i class="fas fa-eye"></i>
                        </button>

                        <!-- Delete Form -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <!-- Edit Button -->
                        <button onclick="window.location.href='{{ route('users.edit', $user->id) }}'">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Activate/Deactivate Button -->
                        <form action="{{ route('users.toggleActivation', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            @if ($user->actived)
                                <button type="submit" class="btn-deactivate">
                                    Deactivate
                                </button>
                            @else
                                <button type="submit" class="btn-activate">
                                    Activate
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .manage-buttons button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .manage-buttons i {
            font-size: 18px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>Manage Users</h1>
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
                        <button onclick="window.location.href='{{ route('users.show', $user->id) }}'">
                            <i class="fas fa-eye"></i>
                        </button>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <button onclick="window.location.href='{{ route('users.edit', $user->id) }}'">
                            <i class="fas fa-edit"></i>
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
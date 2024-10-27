<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>
    <h1>Editar Usuario</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required><br>

        <label for="role">Rol:</label>
        <input type="text" id="role" name="role" value="{{ old('role', $user->role) }}" required><br>

        <label for="actived">Activo:</label>
        <select name="actived" id="actived" required>
            <option value="1" {{ $user->actived ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ !$user->actived ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('users.index') }}">Volver a la lista de usuarios</a>
</body>
</html>

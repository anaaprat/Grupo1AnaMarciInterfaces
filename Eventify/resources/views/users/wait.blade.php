<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esperando Activación</title>
</head>
<body>
    <h1>Cuenta Confirmada</h1>
    <p>Tu cuenta ha sido confirmada. Por favor, espera a que un administrador active tu cuenta.</p>
    <div>
            <!-- Otros elementos de la vista -->

            <!-- Botón de Logout -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Volver al login</button>
            </form>
        </div>
</body>
</html>
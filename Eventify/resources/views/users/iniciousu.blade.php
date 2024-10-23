<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuario</title>
</head>
<body>
    <h1>Bienvenido {{ Auth::user()->name }}</h1>
    <p>Esta es la vista principal para usuarios regulares.</p>
</body>
</html>

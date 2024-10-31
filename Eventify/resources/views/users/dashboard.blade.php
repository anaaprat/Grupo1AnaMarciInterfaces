<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background: #4B3C80; 
            color: white; 
            font-family: 'Roboto', sans-serif;
            text-align: center; 
            padding: 20px; 
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem; 
            margin-bottom: 30px; 
        }

        a {
            color: #e63946;
            text-decoration: none; 
            padding: 10px 15px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1); 
            transition: background 0.3s;
        }

        a:hover {
            background: rgba(255, 255, 255, 0.3); 
        }
    </style>
</head>

<body>
    <h1>Bienvenido al Dashboard</h1>
    <p>Esta es una vista temporal para los usuarios.</p>
    
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>

</html>

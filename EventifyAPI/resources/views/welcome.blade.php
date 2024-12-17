<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Eventify</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                background-color: #f3f4f6;
                color: #333;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            .container {
                text-align: center;
                padding: 2rem;
                background-color: #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            h1 {
                color: #e3342f;
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.25rem;
                margin-bottom: 2rem;
                color: #555;
            }

            a {
                text-decoration: none;
                color: #fff;
                background-color: #e3342f;
                padding: 0.75rem 1.5rem;
                border-radius: 5px;
                font-weight: bold;
                margin: 0 0.5rem;
            }

            a:hover {
                background-color: #cc1f1a;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Welcome to Eventify</h1>
            <p>The best place to find your events and the fastest way to register in them.</p>
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endif
        </div>
    </body>
</html>
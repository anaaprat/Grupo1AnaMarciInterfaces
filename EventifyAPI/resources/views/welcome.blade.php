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
                background-color: #fef6e4; 
                color: #333;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                position: relative;
            }

            .header {
                position: absolute;
                top: 20px;
                right: 20px;
            }

            .header a {
                text-decoration: none;
                color: #fff;
                background-color: #ff6f61;
                padding: 0.5rem 1rem;
                border-radius: 5px;
                font-weight: bold;
                margin: 0 0.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .header a:hover {
                background-color: #e85b51;
                transform: translateY(-2px); 
            }

            .container {
                text-align: center;
                padding: 2.5rem;
                background-color: #ffffff;
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
                border-radius: 15px;
                max-width: 600px;
                width: 90%;
            }

            h1 {
                color: #ff6f61;
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                color: #555;
                line-height: 1.6;
            }

            .footer {
                margin-top: 2rem;
                font-size: 0.9rem;
                color: #aaa;
            }
        </style>
    </head>
    <body>
        <div class="header">
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endif
        </div>
        <div class="container">
            <h1>Welcome to Eventify</h1>
            <p>Explore and register for your favorite events, all in one place. Let Eventify make your experience seamless and enjoyable!</p>
        </div>
    </body>
</html>

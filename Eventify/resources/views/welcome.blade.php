<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            height: 100%;
            overflow: hidden;
            color: #fff;
            position: relative;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(8px) brightness(0.7); 
            transition: background-image 1s ease;
            z-index: -1;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem; 
            color: rgba(255, 255, 255, 0.4); 
            cursor: pointer;
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            z-index: 1;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .arrow:hover {
            background-color: rgba(0, 0, 0, 0.5);
            color: rgba(255, 255, 255, 0.7);
        }

        .arrow-left {
            left: 10px;
        }

        .arrow-right {
            right: 10px;
        }

        .container {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 1000px;
            width: 100%;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .title {
            font-size: 60px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 22px;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.8);
        }

        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 3;
        }

        .btn {
            padding: 15px 30px;
            font-size: 18px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #ff4081;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #e33767;
        }

        .btn-secondary {
            background-color: #fff;
            color: #9c27b0;
        }

        .btn-secondary:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="background" id="background"></div>

    <div class="arrow arrow-left" onclick="prevImage()">&#9664;</div>
    <div class="arrow arrow-right" onclick="nextImage()">&#9654;</div>

    <div class="top-right-buttons">
        @if (Route::has('login'))
            <a href="{{ route('login') }}">
                <button class="btn btn-primary">Login</button>
            </a>
        @endif

        @if (Route::has('register'))
            <a href="{{ route('register') }}">
                <button class="btn btn-secondary">Register</button>
            </a>
        @endif
    </div>

    <div class="container">
        <h1 class="title">Welcome to Eventify</h1>
        <p class="subtitle">Create and explore exciting events in music, sports, and technology. Join us and be part of the action!</p>
    </div>

    <script>
        const images = [
            @php
                $images = glob(public_path('storage/imagesEvent/*.{jpg,png,jpeg,gif}'), GLOB_BRACE);
                foreach ($images as $image) {
                    echo "'" . asset('storage/imagesEvent/' . basename($image)) . "',";
                }
            @endphp
        ];

        let currentIndex = 0;

        const background = document.getElementById('background');
        background.style.backgroundImage = `url(${images[currentIndex]})`;

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length; 
            background.style.backgroundImage = `url(${images[currentIndex]})`;
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length; 
            background.style.backgroundImage = `url(${images[currentIndex]})`;
        }

        setInterval(nextImage, 4000);
    </script>
</body>
</html>

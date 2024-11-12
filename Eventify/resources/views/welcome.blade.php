<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>

    <!-- Link to Google Fonts for a modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        /* Global reset and styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            height: 100%;
            overflow: hidden;
            color: #fff;
            position: relative;
        }

        /* Background image styling */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(8px) brightness(0.7); /* Apply blur and dim the images */
            transition: background-image 1s ease; /* Smooth transition */
            z-index: -1;
        }

        /* Arrow styling */
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem; /* Smaller arrow size */
            color: rgba(255, 255, 255, 0.4); /* Slightly transparent color */
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

        /* Button position on the top right */
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
    <!-- Background that changes -->
    <div class="background" id="background"></div>

    <!-- Left and right arrows -->
    <div class="arrow arrow-left" onclick="prevImage()">&#9664;</div>
    <div class="arrow arrow-right" onclick="nextImage()">&#9654;</div>

    <!-- Buttons in top-right corner -->
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

    <!-- Main content -->
    <div class="container">
        <h1 class="title">Welcome to Eventify</h1>
        <p class="subtitle">Create and explore exciting events in music, sports, and technology. Join us and be part of the action!</p>
    </div>

    <!-- JavaScript for controlling background images -->
    <script>
        // Array to hold the URLs of images dynamically
        const images = [
            @php
                $images = glob(public_path('storage/imagesEvent/*.{jpg,png,jpeg,gif}'), GLOB_BRACE);
                foreach ($images as $image) {
                    echo "'" . asset('storage/imagesEvent/' . basename($image)) . "',";
                }
            @endphp
        ];

        let currentIndex = 0;

        // Set the initial background image
        const background = document.getElementById('background');
        background.style.backgroundImage = `url(${images[currentIndex]})`;

        // Function to go to the next image
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length; // Loop back to the start
            background.style.backgroundImage = `url(${images[currentIndex]})`;
        }

        // Function to go to the previous image
        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop back to the end
            background.style.backgroundImage = `url(${images[currentIndex]})`;
        }

        // Automatically change background every 5 seconds
        setInterval(nextImage, 5000);
    </script>
</body>
</html>

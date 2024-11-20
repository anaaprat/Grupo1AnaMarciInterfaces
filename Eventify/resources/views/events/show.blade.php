<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event - {{ $event->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f7fc;
            color: #333;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #6f5f9d;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .event-title {
            font-size: 32px;
            font-weight: bold;
            color: #6f5f9d;
            margin-bottom: 10px;
        }

        .event-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .event-details .detail {
            margin-bottom: 15px;
            width: 48%;
        }

        .event-details .detail strong {
            color: #6f5f9d;
        }

        .description {
            margin-top: 30px;
            line-height: 1.6;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container a {
            text-decoration: none;
            padding: 12px 30px;
            background-color: #2ecc71;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-container a:hover {
            background-color: #27ae60;
        }

        .btn-container .btn-back {
            background-color: #e74c3c;
        }

        .btn-container .btn-back:hover {
            background-color: #c0392b;
        }

        .event-location {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #6f5f9d;
        }

        .large-photo {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 999;
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        .large-photo.active {
            display: flex;
            opacity: 1;
        }

        .large-photo img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .large-photo .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .large-photo .close-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .event-image img {
            width: 100%;
            height: auto;
            max-width: 200px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .event-image img:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header>
        <h1>Event Details</h1>
    </header>

    <div class="container">
        <div class="event-title">{{ $event->title }}</div>

        <div class="event-details">
            <div class="detail">
                <strong>Start Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('F d, Y H:i') }}
            </div>
            <div class="detail">
                <strong>End Time:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('F d, Y H:i') }}
            </div>
            <div class="detail">
                <strong>Price:</strong> ${{ $event->price }}
            </div>
            <div class="detail">
                <strong>Max Attendees:</strong> {{ $event->max_attendees }}
            </div>
        </div>

        <div class="event-image" id="eventImage" style="margin-top: 20px;">
            <img src="{{ asset('/storage/imagesEvent/' . $event->image_url) }}">
        </div>

        <div class="description">
            <strong>Description:</strong>
            <p>{{ $event->description }}</p>
        </div>

        <div class="event-location">
            <i class="fas fa-map-marker-alt"></i> Location: {{ $event->location }}
        </div>

        <div class="btn-container">
            <!-- Botón "Volver" condicional -->
            @if($isOrganizer)
                <a href="{{ route('events.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to My Events (Organizer)
                </a>
            @else
                <a href="{{ route('users.userEvents') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to My Events
                </a>
            @endif
        </div>
    </div>

    <div class="large-photo" id="largePhoto">
        <button class="close-btn" id="closeBtn">&times;</button>
        <img id="largeImage" src="" alt="Event Image">
    </div>

    <script>
        const eventImage = document.getElementById('eventImage');
        const largePhoto = document.getElementById('largePhoto');
        const largeImage = document.getElementById('largeImage');
        const closeBtn = document.getElementById('closeBtn');

        eventImage.addEventListener('click', () => {
            largePhoto.classList.add('active');
            largeImage.src = eventImage.querySelector('img').src;
        });

        closeBtn.addEventListener('click', () => {
            largePhoto.classList.remove('active');
        });

        largePhoto.addEventListener('click', (event) => {
            if (event.target === largePhoto) {
                largePhoto.classList.remove('active');
            }
        });
    </script>
</body>

</html>

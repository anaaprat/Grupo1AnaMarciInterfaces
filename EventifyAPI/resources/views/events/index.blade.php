<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            /* Un gris suave para el fondo */
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #e60000;
            transform: scale(1.05);
        }

        table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th {
            background-color: #ff4d4d;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            text-align: center;
        }

        td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #ffe6e6;
            transition: background-color 0.3s ease;
        }

        .event-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            /* Ajustar imagen dentro del círculo */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>🎉 Event List</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Organizer</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Category</td>
                    <td>Start Date & Time</td>
                    <td>End Date & Time</td>
                    <td>Event Price</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/' . $event->image_url) }}" 
                                 alt="Event Image" 
                                 class="event-image">
                        </td>
                        <td>{{ $event->organizer->name }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>${{ number_format($event->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

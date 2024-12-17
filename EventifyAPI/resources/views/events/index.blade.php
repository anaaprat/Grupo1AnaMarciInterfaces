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
            background-color: #fef6e4;
            /* Fondo pastel */
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ff6f61;
            /* Coral suave */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logout-btn:hover {
            background-color: #e85b51;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        table {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th {
            background-color: #ff6f61;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            text-align: center;
            padding: 12px;
        }

        td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #fff8f5;
            /* Tonos claros */
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            margin-top: 40px;
            max-width: 1200px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>🎉 Event List</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <!-- Event Table -->
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

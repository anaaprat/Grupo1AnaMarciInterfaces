<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
        }

        .event-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Events Registered by {{ $user->name }}</h1>
    </div>

    <!-- Tabla de eventos -->
    <table>
        <thead>
            <tr>
                <th>Event Image</th>
                <th>Event Title</th>
                <th>Organizer</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td><img src="{{ $event->base64_image }}" class="event-img" alt="Event Image"></td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->organizer->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
</body>

</html>

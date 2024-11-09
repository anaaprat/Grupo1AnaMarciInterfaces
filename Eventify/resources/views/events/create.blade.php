<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #4B3C80;
            color: white;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            position: relative;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
        }

        .form-group button {
            background-color: #2ecc71;
            border: none;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #27ae60;
        }

        .btn-back {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <h1>Add New Event</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="1">Music</option>
                <option value="2">Sport</option>
                <option value="3">Technology</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <div style="display: flex; gap: 10px;">
                <select name="start_hour" id="start_hour" required>
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                    @endfor
                </select>
                <span>:</span>
                <select name="start_minute" id="start_minute" required>
                    @for ($i = 0; $i < 60; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <div style="display: flex; gap: 10px;">
                <select name="end_hour" id="end_hour" required>
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                    @endfor
                </select>
                <span>:</span>
                <select name="end_minute" id="end_minute" required>
                    @for ($i = 0; $i < 60; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" required>
        </div>

        <div class="form-group">
            <label for="max_attendees">Max Attendees</label>
            <input type="number" name="max_attendees" id="max_attendees" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>

        <div class="form-group">
            <button type="submit">Create Event</button>
        </div>
    </form>

    <a href="{{ route('events.index') }}" class="btn-back">Back to Events</a>
</body>

</html>

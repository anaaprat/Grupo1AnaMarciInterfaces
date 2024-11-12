<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #EADAF5;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #4B3C80;
        }

        .container {
            width: 90%;
            max-width: 700px;
            background: #FFFFFF;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #D6C1E8;
        }

        h1 {
            font-size: 30px;
            color: #4B3C80;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #6B5294;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #C3AEE4;
            border-radius: 8px;
            background-color: #F7F2FD;
            color: #4B3C80;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #A083C9;
            outline: none;
            box-shadow: 0px 0px 6px rgba(75, 60, 128, 0.2);
        }

        .form-group textarea {
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            padding: 12px 18px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;
            color: #FFFFFF;
            width: 48%;
        }

        .btn-create {
            background-color: #7E57C2;
        }

        .btn-create:hover {
            background-color: #6B5294;
            box-shadow: 0px 4px 10px rgba(110, 90, 160, 0.3);
        }

        .btn-back {
            background-color: #AB7EDA;
        }

        .btn-back:hover {
            background-color: #9A64C7;
            box-shadow: 0px 4px 10px rgba(140, 110, 180, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Event</h1>
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" name="title" id="title" value="{{ $event->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $event->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" value="{{ $event->location }}" required>
            </div>

            <div class="form-group">
                <label for="max_attendees">Max Attendees</label>
                <input type="number" name="max_attendees" id="max_attendees" value="{{ $event->max_attendees }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ $event->price }}" required>
            </div>

            <div class="form-group">
                <label for="image_file">Event Image</label>
                <input type="file" name="image_file" id="image_file" accept="image/*">
            </div>

            <div class="button-group">
                <button type="submit" class="button btn-create">Update Event</button>
                <a href="{{ route('events.index') }}" class="button btn-back">Back to Events</a>
            </div>
        </form>
    </div>
</body>
</html>

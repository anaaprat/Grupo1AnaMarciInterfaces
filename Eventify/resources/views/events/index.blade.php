<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
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
        .btn-logout {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        .menu {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #6f5f9d;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1000;
        }
        .menu-item {
            position: relative;
            cursor: default;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .menu-item:hover {
            background-color: #5a4a78;
        }
        .dropdown {
            display: none;
            position: absolute;
            background-color: #8b7da7;
            border-radius: 5px;
            z-index: 1000;
            padding: 10px;
            margin-top: -10px;
            width: 150px;
            left: 50%;
            transform: translateX(-50%);
            bottom: 100%;
        }
        .menu-item:hover .dropdown {
            display: block;
        }
        .category,
        .clear-filters {
            padding: 5px 10px;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 3px;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        .category:hover,
        .clear-filters:hover {
            background-color: #7c6e9a;
        }
        .category i,
        .clear-filters i {
            margin-right: 8px;
        }
        .btn-add {
            background-color: #2ecc71;
            border: none;
            color: white;
            padding: 15px 20px;
            border-radius: 50%;
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 24px;
            transition: background-color 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-add:hover {
            background-color: #27ae60;
        }

       
        .event-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; 
        }

        .event-card {
            background: #8b5cf6;
            border-radius: 10px;
            padding: 15px;
            width: 45%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .event-card h5 {
            color: #fff;
            font-weight: bold;
        }
        .event-card p {
            color: #d1c4e9;
        }
        .event-card .manage-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .manage-buttons button {
            background-color: transparent;
            border: 1px solid #fff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .manage-buttons button:hover {
            background-color: #7c6e9a;
        }

        .btn-manage {
            background-color: #5b3f8d;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }
        .btn-manage:hover {
            background-color: #7c6e9a;
        }
    </style>
</head>
<body>
    <button class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
    </button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <h1>Manage Events</h1>
    <div class="menu">
        <div class="menu-item">
            Events
            <div class="dropdown">
                <div class="category" onclick="filterEvents(1)">
                    <i class="fas fa-music"></i> Music
                </div>
                <div class="category" onclick="filterEvents(2)">
                    <i class="fas fa-futbol"></i> Sport
                </div>
                <div class="category" onclick="filterEvents(3)">
                    <i class="fas fa-laptop"></i> Technology
                </div>
                <div class="clear-filters" onclick="clearFilters()">
                    <i class="fas fa-times-circle"></i> Clear Filters
                </div>
            </div>
        </div>
    </div>
    
    <div class="event-list">
        @foreach ($events as $event)
            @if($event->deleted == 0)
                <div class="event-card" data-category-id="{{ $event->category_id }}">
                    <h5>{{ $event->title }}</h5>
                    <p>{{ $event->description }}</p>
                    <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <div class="manage-buttons">
                        <a href="{{ route('events.show', $event->id) }}" title="View">
                            <button>
                                <i class="fas fa-eye"></i> View
                            </button>
                        </a>
                        <a href="{{ route('events.edit', $event->id) }}" title="Edit">
                            <button>
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <a href="{{ route('events.create') }}" class="btn-add">
        <i class="fas fa-plus"></i>
    </a>

    <script>
        function filterEvents(categoryId) {
            const cards = document.querySelectorAll('.event-card');
            cards.forEach(card => {
                card.style.display = card.getAttribute('data-category-id') == categoryId ? '' : 'none';
            });
        }

        function clearFilters() {
            const cards = document.querySelectorAll('.event-card');
            cards.forEach(card => card.style.display = '');
        }
    </script>
</body>
</html>

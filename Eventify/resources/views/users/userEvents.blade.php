@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('sendEventsPdf') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: #5B3F8D; border: none;">Send
                Events</button>
        </form>
    </div>

    <h1 class="text-center"
        style="color: #5B3F8D; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        My Registered Events
    </h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Submenú -->
    <div class="text-center mb-4">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="eventsDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Events
            </button>
            <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
                <li><a class="dropdown-item" href="{{ route('users.dashboard') }}">All Events</a></li>
                <li><a class="dropdown-item" href="{{ route('users.userEvents') }}">My Events</a></li>
            </ul>
        </div>
    </div>

    <!-- Mensaje si no hay eventos registrados -->
    @if($eventsUser->isEmpty())
        <div class="alert alert-info text-center">
            You are not registered for any events.
        </div>
    @else
        <!-- Lista de eventos -->
        <div class="row mt-4">
            @foreach($eventsUser as $event)
                <div class="col-md-4 mb-4 event-card">
                    <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px; background-color: #F9F4FB;">
                        <div class="card-body">
                            <img src="{{ asset('/storage/imagesEvent/' . $event->image_url) }}" class="card-img-top"
                                style="border-radius: 8px; height: 200px; object-fit: cover;" alt="Event Image">

                            <h5 class="card-title" style="color: #5B3F8D; font-weight: bold;">{{ $event->name }}</h5>
                            <p class="card-text" style="color: #6c6f88;">{{ $event->description }}</p>

                            <p class="card-text text-muted">
                                <strong style="color: #5B3F8D;">Organizer:</strong> {{ $event->organizer->name }}
                            </p>

                            <p class="card-text text-muted">
                                <strong style="color: #5B3F8D;">Event Date:</strong>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}
                            </p>

                            <p class="card-text text-muted">
                                <strong style="color: #5B3F8D;">Registration Date:</strong>
                                {{ \Carbon\Carbon::parse($event->pivot->created_at)->format('d/m/Y') }}
                            </p>

                            <!-- Botones "Unregister" y "View Details" uno al lado del otro -->
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('events.unregister', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Unregister</button>
                                </form>

                                <a href="{{ route('events.show', $event->id) }}" class="btn"
                                    style="background-color: #5B3F8D; color: white;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
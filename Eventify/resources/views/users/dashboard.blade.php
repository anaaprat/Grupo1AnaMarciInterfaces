@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center"
        style="color: #5B3F8D; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        Available Events
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

    <!-- Menú desplegable siempre visible -->
    <div class="text-center mb-4">
        <div class="dropdown d-inline-block">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="eventsMenu" data-bs-toggle="dropdown" aria-expanded="false">
                Events
            </button>
            <ul class="dropdown-menu" aria-labelledby="eventsMenu">
                <li><a class="dropdown-item" href="#" id="all-events">All Events</a></li>
                <li><a class="dropdown-item" href="{{ route('users.userEvents') }}" id="my-events">My Events</a></li>
            </ul>
        </div>
    </div>

    <!-- Mensaje si no hay eventos disponibles -->
    @if($eventos->isEmpty())
        <div class="alert alert-warning text-center" style="font-size: 18px; font-weight: bold;">
            <i class="bi bi-calendar-x" style="font-size: 24px;"></i>
            No events are available at the moment. Please check back later!
        </div>
    @else
        <!-- Lista de eventos -->
        <div class="row mt-4">
            @foreach($eventos as $event)
                <div class="col-md-4 mb-4 event-card" data-category="{{ strtolower($event->category) }}">
                    <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px; background-color: #F9F4FB;">
                        <div class="card-body">
                            <!-- Imagen del evento -->
                            <div class="event-photo">
                                <img src="{{ asset('/storage/imagesEvent/' . $event->image_url) }}" 
                                     class="card-img-top"
                                     style="border-radius: 8px; height: 200px; object-fit: cover;" 
                                     alt="Event Image">
                            </div>

                            <h5 class="card-title" style="color: #5B3F8D; font-weight: bold;">{{ $event->name }}</h5>
                            <p class="card-text" style="color: #6c6f88;">{{ $event->description }}</p>
                            <p class="card-text text-muted">
                                <strong style="color: #5B3F8D;">Organizer:</strong> {{ $event->organizer->name }}
                            </p>
                            <p class="card-text text-muted">
                                <strong style="color: #5B3F8D;">Date:</strong>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}
                            </p>
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn"
                                    style="background-color: #5B3F8D; color: white;">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
@endsection

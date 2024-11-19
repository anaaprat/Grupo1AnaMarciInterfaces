@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center" style="color: #5B3F8D; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">Available Events</h1>

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

        @if($eventos->isEmpty()) 
            <div class="alert alert-info text-center">
                No events are available for tomorrow or later.
            </div>
        @else
            <div class="row">
                @foreach($eventos as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px; background-color: #F9F4FB;">
                            <div class="card-body">
                                <!-- Mostrar la imagen del evento con el modal -->
                                <img src="{{ asset('/storage/imagesEvent/' . $event->image_url) }}" 
                                     class="card-img-top" 
                                     style="border-radius: 8px; height: 200px; object-fit: cover; cursor: pointer;" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#imageModal" 
                                     data-bs-image="{{ asset('/storage/imagesEvent/' . $event->image_url) }}" 
                                     alt="Event Image">
                                
                                <h5 class="card-title" style="color: #5B3F8D; font-weight: bold;">{{ $event->name }}</h5>
                                <p class="card-text" style="color: #6c6f88;">{{ $event->description }}</p>
                                
                                <!-- Nombre del organizador -->
                                <p class="card-text text-muted">
                                    <strong style="color: #5B3F8D;">Organizer:</strong> {{ $event->organizer->name }}
                                </p>
                                
                                <p class="card-text text-muted">
                                    <strong style="color: #5B3F8D;">Date:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}
                                </p>
                                
                                <form action="{{ route('events.register', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn" style="background-color: #5B3F8D; color: white;">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Event Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" class="img-fluid" alt="Event Image">
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        // Función que se ejecuta cuando el modal se abre
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            // Obtén la URL de la imagen desde el atributo 'data-bs-image' del elemento que disparó el evento
            var button = event.relatedTarget; // Botón que activó el modal
            var imageUrl = button.getAttribute('data-bs-image');
            var modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl; // Asigna la URL al <img> dentro del modal
        });
    </script>
@endsection

@section('styles')
    <style>
        .text-lila {
            color: #5B3F8D; 
        }

        .btn {
            background-color: #5B3F8D;
            border-color: #5B3F8D;
            color: white;
        }

        .btn:hover {
            background-color: #8e44ad;
            border-color: #8e44ad;
        }

        .alert-success {
            background-color: #EDE3F2;
            color: #5B3F8D;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.1); 
            border-color: rgba(255, 0, 0, 0.3); 
            color: #5B3F8D; 
        }

        .alert-info {
            background-color: #E8E4F9;
            color: #5B3F8D;
        }

        .card {
            border-radius: 10px;
            border: 1px solid #D6C3E1;
        }

        .card-body {
            padding: 20px;
        }

        .btn-block {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        body {
            background: #4B3C80; 
            color: white;
            font-family: 'Roboto', sans-serif;
        }

        /* Aseguramos que el cursor se convierte en manita */
        .card-img-top {
            cursor: pointer;
        }

        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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

        .user-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        /* Estilo de la imagen del usuario */
        .user-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            cursor: pointer;
            transition: transform 0.3s ease; /* Efecto en el hover */
        }

        .user-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-photo:hover {
            transform: scale(1.05); /* Efecto de hover para la imagen pequeña */
        }

        /* Detalles del usuario */
        .user-details {
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        strong {
            color: #7e1d8e;
            font-weight: bold;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details-table th,
        .details-table td {
            padding: 12px 20px;
            text-align: left;
            font-size: 16px;
        }

        .details-table th {
            background-color: #9e7fe6;
            color: white;
        }

        .details-table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .back-btn {
            background-color: #7e1d8e;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #9c2e91;
        }

        /* Estilo del contenedor para la foto grande (lightbox) */
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

        /* Estilo para cerrar la foto grande */
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

    </style>
</head>

<body>
    
    <div class="user-container">
        <!-- Botón de volver -->
        <a href="{{ route('users.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>

        <div class="user-photo" id="userPhoto">
            <img src="{{ asset('/storage/imagesUser/' . $user->profile_picture) }}" alt="User Profile Picture">
        </div>

        <div class="user-details">
            <h1>User Details</h1>

            <table class="details-table">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="large-photo" id="largePhoto">
        <button class="close-btn" id="closeBtn">&times;</button>
        <img id="largeImage" src="" alt="User Profile Picture">
    </div>

    <script>
        // Obtener los elementos
        const userPhoto = document.getElementById('userPhoto');
        const largePhoto = document.getElementById('largePhoto');
        const largeImage = document.getElementById('largeImage');
        const closeBtn = document.getElementById('closeBtn');

        // Mostrar la foto grande cuando se hace clic en la foto del usuario
        userPhoto.addEventListener('click', () => {
            largePhoto.classList.add('active');
            largeImage.src = userPhoto.querySelector('img').src; // Usar la misma imagen
        });

        // Cerrar la foto grande cuando se hace clic en el botón de cerrar
        closeBtn.addEventListener('click', () => {
            largePhoto.classList.remove('active');
        });

        // Cerrar la foto grande cuando se hace clic fuera de la imagen
        largePhoto.addEventListener('click', (event) => {
            if (event.target === largePhoto) {
                largePhoto.classList.remove('active');
            }
        });
    </script>
</body>

</html>

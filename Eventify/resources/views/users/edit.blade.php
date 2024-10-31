<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #a78bfa, #d6bcfa);
            color: white;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        input:focus,
        select:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
        }

        select option {
            color: #4B3C80; /* Lila oscuro para las opciones de Yes/No */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #a78bfa;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #9b6cc4;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-align: center;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="{{ old('role', $user->role) }}" required>

            <label for="actived">Active:</label>
            <select name="actived" id="actived" required>
                <option value="1" {{ $user->actived ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$user->actived ? 'selected' : '' }}>No</option>
            </select>

            <button type="submit">Update</button>
        </form>

        <a href="{{ route('users.index') }}">Back to User List</a>
    </div>
</body>

</html>

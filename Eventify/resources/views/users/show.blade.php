<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #a78bfa, #d6bcfa);
            color: white;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            display: flex; 
            justify-content: center;
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%; 
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: left; 
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        strong {
            color: #7e1d8e; 
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-align: center;
            text-decoration: underline;
            font-size: 16px;
        }

        a:hover {
            color: #d6bcfa; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <a href="{{ route('users.index') }}">Back</a>
    </div>
</body>
</html>

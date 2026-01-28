1<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Aspirasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #dff7fb;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            width: 350px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #5b4bc4;
            border: none;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #4637a5;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card">

    {{-- Logo --}}
    <img src="{{ asset('logo.png') }}" class="logo">

    <h2>Portal Aspirasi</h2>

    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="username" placeholder="Masukan Username" value="{{ old('username') }}">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Masukan Password">
        </div>

        <button type="submit">Login</button>
    </form>

</div>

</body>
</html>

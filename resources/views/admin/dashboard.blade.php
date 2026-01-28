<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #dff7fb;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .menu a {
            margin-left: 20px;
            text-decoration: none;
            color: black;
            font-weight: 500;
        }

        /* CONTENT */
        .container {
            padding: 40px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .badge {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .green { background: green; }
        .yellow { background: gold; }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 15px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .small {
            font-size: 12px;
            color: gray;
            margin-top: 20px;
        }

        .logout {
            background: crimson;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>
        <strong>Merdeka Aspirasi Website</strong>
    </div>

    <div class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        <a href="{{ route('admin.feedback') }}">Feedback</a>
        <a href="#">Student</a>

        <span>{{ $user->full_name }}</span>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button class="logout">Logout</button>
        </form>
    </div>
</div>


<div class="container">

    <!-- COMPLETE -->
    <div class="section-title">
        <span class="badge green"></span> Complete
    </div>

    <div class="grid">
        @for($i=0;$i<3;$i++)
        <div class="card">
            <strong>Feedback title</strong>
            <p>ini isi yang sangat berbobot</p>
            <div class="small">Created by : siswa</div>
        </div>
        @endfor
    </div>


    <!-- IN PROGRESS -->
    <div class="section-title">
        <span class="badge yellow"></span> In Progress
    </div>

    <div class="grid">
        @for($i=0;$i<3;$i++)
        <div class="card">
            <strong>Feedback title</strong>
            <p>ini isi yang sangat berbobot</p>
            <div class="small">Created by : siswa</div>
        </div>
        @endfor
    </div>

</div>

</body>
</html>

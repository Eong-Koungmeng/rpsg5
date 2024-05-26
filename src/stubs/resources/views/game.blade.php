<!DOCTYPE html>
<html>

<head>
    <title>Rock Paper Scissors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">RPS Game</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>

                    @endguest
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Rock Paper Scissors</h1>

        @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
        @endif

        <div class="text-center">
            <h2>Your Score: <span id="score">{{ $score }}</span></h2>
        </div>

        <form method="POST" action="{{ route('play') }}" class="text-center mb-3">
            @csrf
            <div class="btn-group" role="group">
                <button type="submit" name="choice" value="rock" class="btn btn-primary">Rock</button>
                <button type="submit" name="choice" value="paper" class="btn btn-primary">Paper</button>
                <button type="submit" name="choice" value="scissors" class="btn btn-primary">Scissors</button>
            </div>
        </form>

        <form method="POST" action="{{ route('reset') }}" class="text-center mb-3">
            @csrf
            <button type="submit" class="btn btn-danger">Reset Score</button>
        </form>

        <form method="POST" action="{{ route('save-score') }}" class="text-center">
            @csrf
            <button type="submit" class="btn btn-success">Save Score</button>
        </form>

        @if (Session::has('game_data'))
        <div id="results" class="mt-5 text-center">
            <h2>Results</h2>
            <p>You chose: <strong>{{ Session::get('game_data.userChoice') }}</strong></p>
            <p>Computer chose: <strong>{{ Session::get('game_data.computerChoice') }}</strong></p>
            <p><strong>{{ Session::get('game_data.result') }}</strong></p>
        </div>
        @endif
    </div>
</body>

</html>
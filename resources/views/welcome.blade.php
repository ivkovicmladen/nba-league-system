<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA League Administration System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .hero-title {
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    @auth
        <!-- If logged in, redirect to dashboard -->
        <script>window.location.href = "{{ route('dashboard') }}";</script>
    @else
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-3 hero-title mb-3">🏀 NBA League System</h1>
                <p class="lead text-white">Professional Basketball League Administration</p>
            </div>

            <div class="row g-4">
                <!-- Login Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover h-100 text-center">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span style="font-size: 4rem;">🔐</span>
                            </div>
                            <h3 class="card-title">Login</h3>
                            <p class="card-text flex-grow-1">Access your account to manage your profile and contracts</p>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-auto">Sign In</a>
                        </div>
                    </div>
                </div>

                <!-- Register Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover h-100 text-center">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span style="font-size: 4rem;">📝</span>
                            </div>
                            <h3 class="card-title">Register</h3>
                            <p class="card-text flex-grow-1">Create a new account and join the league</p>
                            <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-auto">Sign Up</a>
                        </div>
                    </div>
                </div>

                <!-- Games Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover h-100 text-center">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span style="font-size: 4rem;">🏆</span>
                            </div>
                            <h3 class="card-title">Games</h3>
                            <p class="card-text flex-grow-1">View all completed games and match results</p>
                            <a href="{{ route('games.public') }}" class="btn btn-info btn-lg mt-auto text-white">View Games</a>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover h-100 text-center">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span style="font-size: 4rem;">📊</span>
                            </div>
                            <h3 class="card-title">Statistics</h3>
                            <p class="card-text flex-grow-1">Browse team standings and player statistics</p>
                            <a href="{{ route('stats.public') }}" class="btn btn-warning btn-lg mt-auto">View Stats</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="text-white">
                    <small>© {{ date('Y') }} NBA League Administration System. All rights reserved.</small>
                </p>
            </div>
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
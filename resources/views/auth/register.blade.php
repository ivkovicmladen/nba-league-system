<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NBA League</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .register-card {
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="register-card mx-auto">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h1 class="display-6">🏀 NBA League</h1>
                        <p class="text-muted">Create your account</p>
                    </div>

                    <div class="alert alert-info">
                        <small><strong>Contract Rules:</strong> After registration, you can receive and accept contract offers from teams and admins.</small>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" required autofocus autocomplete="given-name">
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}" required autocomplete="family-name">
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture (Optional) -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Profile Picture (Optional)')" />
                            <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-600">Max 2MB (JPG, PNG, GIF)</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                required autocomplete="new-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                required autocomplete="new-password">
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                Register
                            </button>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0">Already have an account?
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login</a>
                            </p>
                        </div>

                        <div class="text-center mt-3">
                            <a href="/" class="text-muted text-decoration-none small">← Back to Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
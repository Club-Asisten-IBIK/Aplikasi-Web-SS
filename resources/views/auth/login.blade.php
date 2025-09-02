<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDU-PRIMA - Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid login-container">
        <div class="row h-100">
            <!-- Welcome Section - Left Side -->
            <div class="col-md-5 welcome-section">
                <h1 class="welcome-text">Selamat Datang</h1>
                <div class="logo-container">
                    <img src="{{ asset('asset/image.png') }}" class="img-fluid">
                </div>
                <h1 class="school-name">EDU-PRIMA</h1>
                <h1 class="school-name">Education Primary Management</h1>
            </div>

            <!-- Login Section - Right Side -->
            <div class="col-md-7 login-section">
                <div class="container mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-white mb-5 text-center"><b>Admin Login</b></h2>
                            <form class="login-form text-center" method="POST" action="">
                                @csrf

                                <div class="input-group mb-5">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>

                                @error('email')
                                    <span class="text-white">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror

                                <div class="input-group mb-5">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>

                                @error('password')
                                    <span class="text-white">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                                <button type="submit" class="btn login-btn">
                                    Login
                                </button>

                                @if (Route::has('password.request'))
                                    <div class="text-center mt-3">
                                        <a class="text-white" href="{{ route('password.request') }}">
                                            Forgot your password?
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

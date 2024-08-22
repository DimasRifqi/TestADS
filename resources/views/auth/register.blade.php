<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

   <!-- Font Icon -->
   <link rel="stylesheet"
   href="{{ asset('asset_produk/login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

<!-- Main css -->
<link rel="stylesheet" href="{{ asset('asset_produk/login/css/style.css') }}">
</head>
<body>

    <div class="main">

        <!-- Sign up Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('asset_produk/login/images/signin-image.jpg') }}" alt="sign up image"></figure>

                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" action="{{ route('register') }}" class="register-form" id="login-form">
                            @csrf

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>

                            <div class="form-group form-button">
                                <button type="submit" class="form-submit" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 4px;">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>


    <!-- JS -->
    <script src="{{ asset('asset_produk/login/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset_produk/login/js/main.js') }}"></script>
</body>
</html>

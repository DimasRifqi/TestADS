<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('asset_produk/login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('asset_produk/login/css/style.css') }}">
</head>

<body>

    <div class="main">

        <!-- Login form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input id="email" type="email" name="email"
                                    class="@error('email') is-invalid @enderror" placeholder="Your Email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password" name="password"
                                    class="@error('password') is-invalid @enderror" placeholder="Password" required
                                    autocomplete="current-password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember" class="agree-term"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <label for="remember" class="label-agree-term"><span><span></span></span>Remember
                                    Me</label>
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" class="form-submit"
                                    style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 4px;">
                                    Login
                                </button>
                            </div>

                            @if (Route::has('register'))
                            <div class="col-12">
                                <p class="m-0 text-secondary text-center">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="link-primary text-decoration-none">Register</a>
                                </p>
                            </div>
                        @endif


                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('asset_produk/login/images/signup-image.jpg') }}"
                                alt="sing up image"></figure>

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

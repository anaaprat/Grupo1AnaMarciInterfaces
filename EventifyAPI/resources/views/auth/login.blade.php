@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #fef6e4; /* Fondo pastel */
        font-family: 'Arial', sans-serif;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #ff6f61;
        color: white;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 15px 15px 0 0;
        padding: 15px;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #ff6f61;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #e85b51;
        transform: scale(1.05);
    }

    .btn-link {
        color: #ff6f61;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
        color: #e85b51;
    }

    .top-right {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .register-btn {
        background-color: #ff6f61;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
    }

    .register-btn:hover {
        background-color: #e85b51;
        transform: scale(1.05);
        text-decoration: none;
    }
</style>

<div class="container">
    <!-- Register Button in the Top Right -->
    @if (Route::has('register'))
        <div class="top-right">
            <a href="{{ route('register') }}" class="register-btn">Register</a>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

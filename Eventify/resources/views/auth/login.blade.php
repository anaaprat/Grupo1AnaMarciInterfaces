@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px;">
                <div class="card-header text-center" style="background-color: #EDE3F2; color: #5B3F8D; font-weight: bold;">{{ __('Login') }}</div>

                <div class="card-body" style="background-color: #F9F4FB;">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background-color: rgba(255, 0, 0, 0.1); border-color: rgba(255, 0, 0, 0.3); color: #5B3F8D;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="color: #5B3F8D;">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-radius: 8px;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: #FF4C4C;">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="color: #5B3F8D;">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-radius: 8px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: #FF4C4C;">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color: #5B3F8D;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: #5B3F8D; color: white; border-radius: 8px; font-size: 1.1rem;">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #5B3F8D;">
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

<style>
    body {
        background: linear-gradient(135deg, #a78bfa, #d6bcfa);
        color: white;
        font-family: 'Roboto', sans-serif;
    }
    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    .card-header {
        font-size: 1.5rem;
        color: #5B3F8D;
        background: transparent;
        border: none;
    }
    .alert {
        background-color: rgba(255, 0, 0, 0.1); 
        border-color: rgba(255, 0, 0, 0.3); 
        color: #5B3F8D; 
    }
</style>

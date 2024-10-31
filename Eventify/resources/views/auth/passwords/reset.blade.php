@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #a78bfa; color: white; border: none;">
                <div class="card-header" style="background-color: #9e7fe6; color: white;">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ $email ?? old('email') }}" 
                                       required autocomplete="email" autofocus
                                       style="background-color: #d6bcfa; border: none; color: white;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="color: #ffcccc;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       style="background-color: #d6bcfa; border: none; color: white;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="color: #ffcccc;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" 
                                       class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       style="background-color: #d6bcfa; border: none; color: white;">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" 
                                        class="btn" 
                                        style="background-color: #9e7fe6; color: white; width: 100%;">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

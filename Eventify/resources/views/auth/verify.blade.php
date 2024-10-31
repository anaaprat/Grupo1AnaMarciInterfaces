@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px;">
                <div class="card-header text-center" style="background-color: #EDE3F2; color: #5B3F8D; font-weight: bold;">
                    {{ __('Verify Your Email Address') }}
                </div>

                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.1);">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert" style="background-color: rgba(255, 0, 0, 0.1); border-color: rgba(255, 0, 0, 0.3); color: #5B3F8D;">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p style="color: #5B3F8D;">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <br>
                        {{ __('If you did not receive the email') }},
                    </p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn" style="background-color: #5B3F8D; color: white; border-radius: 8px;">
                            {{ __('Click here to request another') }}
                        </button>
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

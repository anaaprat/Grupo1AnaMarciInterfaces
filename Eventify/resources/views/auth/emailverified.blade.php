@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border: 1px solid #D6C3E1; border-radius: 10px;">
                    <div class="card-header text-center" style="background-color: #EDE3F2; color: #5B3F8D; font-weight: bold;">
                        {{ __('Email Verified') }}
                    </div>
                    <div class="card-body" style="background-color: rgba(255, 255, 255, 0.1);">
                        <div class="alert alert-info" role="alert" style="color: #5B3F8D; background-color: rgba(173, 163, 204, 0.1); border: 1px solid #D6C3E1;">
                            {{ __('Your email has been verified correctly. Please wait for the admin to activate your account.') }}
                        </div>
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
</style>

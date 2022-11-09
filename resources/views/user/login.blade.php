@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col"></div>
        <div class="col-12 col-md-8 position-relative">
            <div class="text-center">
                <img src="{{ url('assets/img/logo.png') }}" class="login-logo" alt="">
            </div>
            @if (session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-12 col-md-4 p-5 bg-dark text-light left-login">
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <h4>KOMO Account</h4>
                Username
                <input type="text" name="username" class="form-control my-1">
                Password
                <input type="password" name="password" class="form-control mt-1 mb-2">
                <div class="row">
                    <div class="col pe-1">
                        <button class="btn form-control btn-success"><i class="fas fa-sign-in-alt"></i> &nbsp; Login</button>
                    </div>
                    <div class="col ps-1">
                        <a href="{{ url('register') }}" class="btn form-control btn-outline-success"><i class="fas fa-edit"></i> &nbsp; Register</a>
                    </div>
                </div>
            </form>
            <a href="{{ url('forgot-password') }}">Lost your password?</a>

            <div class="or">
                OR
            </div>
        </div>
        <div class="col-12 col-md-4 p-5 bg-dark text-light">
            <button class="btn mt-2 form-control btn-sso btn-phantom" onclick="phantomLogin()">
                <i class="fas fa-wallet"></i> Connect Phantom Wallet
            </button>
            <a href="{{ url('auth/google') }}" class="btn mt-2 form-control btn-sso btn-google">
                <i class="fab fa-google"></i> Login with Google
            </a>
            <a href="{{ url('auth/facebook') }}" class="btn mt-2 form-control btn-sso btn-facebook">
                <i class="fab fa-facebook"></i> Login with Facebook
            </a>
            <a href="{{ url('auth/twitter') }}" class="btn mt-2 form-control btn-sso btn-twitter">
                <i class="fab fa-twitter"></i> Login with Twitter
            </a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
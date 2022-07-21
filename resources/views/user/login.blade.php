@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-4 my-5 bg-dark text-light p-5">
            <div class="text-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
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
            <form action="{{ url('login') }}" method="POST">
                @csrf
                Username
                <input type="text" name="username" class="form-control my-1">
                Password
                <input type="password" name="password" class="form-control mt-1 mb-2">
                <button class="btn form-control btn-success"><i class="fas fa-sign-in-alt"></i> &nbsp; Login</button>
            </form>
            <center>
            - or -
            </center>
            <a href="{{ url('register') }}" class="btn form-control btn-outline-success"><i class="fas fa-edit"></i> &nbsp; Register</a>
            <br>
            <a href="{{ url('forgot-password') }}">Lost your password?</a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
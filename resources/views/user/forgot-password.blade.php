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
            <form action="{{ url('forgot-password') }}" method="POST">
                @csrf
                Username or email or wallet
                <input type="text" name="find_query" class="form-control my-1">
                <button class="btn form-control btn-success"><i class="fas fa-search"></i> &nbsp; Forgot Password</button>
            </form>
            <br>
            <a href="{{ url('login') }}">Return to login</a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
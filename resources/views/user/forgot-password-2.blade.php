@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-5 my-5 bg-dark text-light p-5">
            <div class="text-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
            </div>
            <div class="my-3">
                Please check your email at {{ $censormail }} to reset your password.
                <br><br>
                If you didn't receive it, please check spam / junk folders.
            </div>
            <br>
            <a href="{{ url('login') }}">Return to login</a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
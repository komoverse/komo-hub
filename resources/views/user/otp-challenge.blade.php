@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-4 my-5 bg-dark text-light p-5">
            <div class="text-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
            </div>
            @if (isset($error))
            <div class="alert alert-danger">
            {{ $error }}
            </div>
            @endif
            <form action="{{ url('otp') }}" method="POST">
                @csrf
                Two Factor Authentication Code
                <input type="text" placeholder="6-digit code" name="otp_input" class="form-control my-1" maxlength="6">
                <button class="btn form-control btn-success"><i class="fas fa-sign-in-alt"></i> &nbsp; Verify</button>
            </form>
            <a href="{{ url('login') }}"><< Return to Login</a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
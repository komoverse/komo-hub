@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-5 my-5 bg-dark text-light p-5">
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
            <form action="{{url('admin/login')}}" method="POST">
                @csrf
                <h2>Login Admin</h2>
                Username
                <input type="text" name="username" class="form-control mb-1">
                Password
                <input type="password" name="password" class="form-control mb-1">
                <input type="submit" class="btn btn-success">
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
@section('script')
@endsection
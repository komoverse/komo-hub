@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-5 my-5 bg-dark text-light p-5">
            <form action="{{url('admin/register')}}" method="POST">
                @csrf
                <h2>Register Admin</h2>
                Username
                <input type="text" name="username" class="form-control mb-1">
                Password
                <input type="password" name="password" class="form-control mb-1">
                Fullname
                <input type="text" name="fullname" class="form-control mb-1">
                <input type="submit" class="btn btn-success">
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
@section('script')
@endsection
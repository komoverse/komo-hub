@extends('user.template')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Verify Your Email</h1>
        <h3>Please check your email and input your verification code below.</h3>
        <form action="verify-email" method="POST">
            @csrf
            <input type="text" class="form-control w-25 d-inline">
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection